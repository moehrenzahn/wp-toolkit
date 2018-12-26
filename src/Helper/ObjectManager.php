<?php

namespace Toolkit\Helper;

/**
 * Class ObjectManager
 *
 * @package Toolkit\Helper
 */
class ObjectManager
{
    /**
     * @var object[]
     */
    private $instances = [];

    /**
     * ObjectManager constructor.
     */
    public function __construct()
    {
        $this->instances[self::class] = $this;
    }


    /**
     * @param string $class Fully qualified class name of object
     * @return object       Requested object
     * @api
     */
    public function getSingleton(string $class)
    {
        if (!isset($this->instances[$class])) {
            $this->instances[$class] = $this->resolveDependenciesWithSingletons($class);
        }

        return $this->instances[$class];
    }

    /**
     * @param string $class
     * @param mixed[] $params
     * @return object
     */
    public static function create(string $class, $params = [])
    {
        return self::resolveDependencies($class, $params);
    }

    /**
     * Try to recursively resolve any dependencies of a class and its dependencies,
     * re-using already instantiated objects
     *
     * @param string $className
     * @return object|false
     */
    private function resolveDependenciesWithSingletons(string $className)
    {
        try {
            $reflection = new \ReflectionClass($className);
            $dependencies = [];
            if ($reflection->getConstructor()) {
                foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                    $paramClassName = $parameter->getClass()->name;
                    if (in_array($paramClassName, array_keys($this->instances))) {
                        // get dependency from $this->instances
                        $dependencies[] = $this->instances[$paramClassName];
                    } elseif ($parameter->isOptional()) {
                        $dependencies[] = $parameter->getDefaultValue();
                    } else {
                        // get dependency via reflection
                        $resolvedDependency = self::resolveDependenciesWithSingletons($paramClassName);
                        $dependencies[] = $resolvedDependency;
                        $this->instances[$paramClassName] = $resolvedDependency;
                    }
                }
            }
            return new $className(...$dependencies);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Try to recursively resolve any dependencies of a class and its dependencies.
     * It is possible to override individual dependencies via the $params parameter.
     *
     * @param string $className
     * @param mixed[] $params
     * @return object
     * @throws \Exception
     */
    private static function resolveDependencies(string $className, array $params)
    {
        try {
            $reflection = new \ReflectionClass($className);
            $dependencies = [];
            if ($reflection->getConstructor()) {
                foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                    if (in_array($parameter->name, array_keys($params))) {
                        // get dependency from params array
                        $dependencies[] = $params[$parameter->getName()];
                    } elseif ($parameter->isOptional()) {
                        $dependencies[] = $parameter->getDefaultValue();
                    } else {
                        // get dependency via reflection
                        $dependencies[] = self::resolveDependencies(
                            $parameter->getClass()->name,
                            $params
                        );
                    }
                }
            }
            try {
                return new $className(...$dependencies);
            } catch (\TypeError $error) {
                throw new \Exception($error->getMessage());
            }
        } catch (\Exception $exception) {
            throw new \Exception("Object manager could not resolve $className: " . $exception->getMessage());
        }
    }
}
