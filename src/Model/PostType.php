<?php

namespace Moehrenzahn\Toolkit\Model;

/**
 * Class PostType
 *
 * @package Moehrenzahn\Toolkit\Model
 */
class PostType
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $plural;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $description;

    /**
     * PostType constructor.
     *
     * @param $label
     * @param $plural
     * @param string $icon
     * @param string $description
     */
    public function __construct(
        string $label,
        string $plural,
        string $description = '',
        string $icon = 'dashicons-admin-post'
    ) {
        $this->label = $label;
        $this->plural = $plural;
        $this->icon = $icon;
        $this->description = $description;
        /**
         * Do not use 'init' action hook to make registered post types available during other setup actions.
         */
        $this->register();
    }

    /**
     * Register Post type with WordPress
     */
    private function register()
    {
        $replace = [
            'ö' => 'oe',
            'ä' => 'ae',
            'ü' => 'ue',
            ' ' => '_',
        ];
        $slug = str_replace(array_keys($replace), $replace, strtolower($this->label));

        register_post_type(
            $slug,
            [
                'labels' => [
                    'name' => "{$this->plural}",
                    'singular_name' => "{$this->label}",
                    'menu_name' => "{$this->plural}",
                    'name_admin_bar' => "{$this->label}",
                    'add_new' => "Hinzufügen",
                    'add_new_item' => "Neue {$this->label} hinzufügen",
                    'new_item' => "Neue {$this->label}",
                    'edit_item' => "{$this->label} bearbeiten",
                    'view_item' => "{$this->label} anzeigen",
                    'all_items' => "Alle {$this->plural}",
                    'search_items' => "{$this->label} suchen",
                    'parent_item_colon' => "Parent {$this->plural}:",
                    'not_found' => "Keine {$this->plural} gefunden.",
                    'not_found_in_trash' => "Keine {$this->plural} im Papierkorb.",
                ],
                'description' => $this->description,
                'public' => true,
                'publicly_queriable' => true,
                'show_ui' => true,
                'show_in_nav_menu' => true,
                'exclude_from_search' => false,
                'menu_icon' => $this->icon,
                'supports' => array('editor', 'title', 'thumbnail', 'excerpt')
            ]
        );
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
