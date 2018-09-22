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

    public function addAction($hook, $component, $callback)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback);
    }

    public function addFilter($hook, $component, $callback)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback);
    }

    public function addShortcode($code, $component, $callback)
    {
        $this->shortcodes = $this->add($this->shortcodes, $code, $component, $callback);
    }

    private function add($hooks, $hook, $component, $callback)
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
