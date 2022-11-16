<?php

namespace Moehrenzahn\Toolkit\Model;

/**
 * Class TaxonomyType
 *
 * @package Moehrenzahn\Toolkit\Model
 */
class TaxonomyType
{
    private string $label;

    private string $postTypeSlug;

    private string $plural;

    private array $labels;

    private array $params;

    public function __construct(
        string $label,
        string $postTypeSlug,
        string $plural,
        array $labels = [],
        array $params = []
    ) {
        $this->label = $label;
        $this->postTypeSlug = $postTypeSlug;
        $this->plural = $plural;
        $this->labels = $labels;
        $this->params = $params;
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
        $slug = sanitize_key($this->label);

        $params = array_merge($this->getDefaultParams(), $this->params);
        $params['labels'] = array_merge($this->getDefaultLabels(), $this->labels);

        register_taxonomy($slug, $this->postTypeSlug, $params);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    public function getDefaultParams(): array
    {
        return [
            'public' => true,
        ];
    }

    public function getDefaultLabels(): array
    {
        return [
            'name' => "{$this->plural}",
            'singular_name' => "{$this->label}",
            'search_items' => "Search {$this->plural}",
            'popular_items' => "Frequent {$this->plural}",
            'all_items' => "All {$this->plural}",
            'edit_item' => "Edit {$this->label}",
            'view_item' => "View {$this->label}",
            'add_new_item' => "New {$this->label}",
            'parent_item' => "Parent {$this->label}",
            'parent_item_colon' => "Parent {$this->label}:",
            'update_item' => "Update {$this->label}",
            'new_item_name' => "New {$this->label} name",
            'separate_items_with_commas' => "Separate {$this->plural} with commas",
            'add_or_remove_items' => "Add or remove {$this->plural}",
            'choose_from_most_used' => "Choose from the most used {$this->plural}",
            'not_found' => "No {$this->plural} found",
            'no_terms' => "No {$this->plural}",
            'filter_by_item' => "Filter by category {$this->label}",
            'items_list_navigation' => "",
            'items_list' => "",
            'most_used' => "Most used",
            'back_to_items' => "",
            'item_link' => "{$this->label} link",
            'item_link_description' => "A link to a {$this->label}",
        ];
    }
}
