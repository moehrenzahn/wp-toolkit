<?php

namespace Toolkit;

/**
 * Class Loader
 *
 * Code adapted from
 * https://code.tutsplus.com/tutorials/object-oriented-programming-in-wordpress-building-the-plugin-ii--cms-21105
 *
 * @package Toolkit
 */
class Loader
{
    /**
     * @var array
     */
    protected $actions = [];

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var array
     */
    protected $shortcodes = [];

    /**
     * @param string $hook
     * @param object $component
     * @param string|callable $callback
     */
    public function addAction(string $hook, $component, $callback)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback);
    }

    /**
     * @param string $hook
     * @param mixed $component
     * @param string $callback
     */
    public function addFilter(string $hook, $component, string $callback)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback);
    }

    /**
     * @param string $code
     * @param mixed $component
     * @param string $callback
     */
    public function addShortcode(string $code, $component, string $callback)
    {
        $this->shortcodes = $this->add($this->shortcodes, $code, $component, $callback);
    }

    /**
     * @param array $hooks
     * @param string $hook
     * @param $component
     * @param string|callable $callback
     * @return array
     */
    private function add(array $hooks, string $hook, $component, $callback): array
    {
        $hooks[] = [
            'hook'      => $hook,
            'component' => $component,
            'callback'  => $callback
        ];

        return $hooks;
    }

    public function run()
    {
        foreach ($this->filters as $hook) {
            if (!$hook['component']) {
                add_filter($hook['hook'], $hook['callback']);
            } else {
                add_filter($hook['hook'], [$hook['component'], $hook['callback']]);
            }
        }

        foreach ($this->shortcodes as $hook) {
            if (!$hook['component']) {
                add_shortcode($hook['hook'], $hook['callback']);
            } else {
                add_shortcode($hook['hook'], [$hook['component'], $hook['callback']]);
            }
        }

        foreach ($this->actions as $hook) {
            if (!$hook['component']) {
                add_action($hook['hook'], $hook['callback']);
            } else {
                add_action($hook['hook'], [$hook['component'], $hook['callback']]);
            }
        }
    }
}
