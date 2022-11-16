<?php

namespace Moehrenzahn\Toolkit;

/**
 * Class TaxonomyType
 *
 * @package Moehrenzahn\Toolkit\Model
 */
class TaxonomyType
{
    /**
     * @var \Moehrenzahn\Toolkit\Model\TaxonomyType[]
     */
    private $types = [];

    public function add(
        string $label,
        string $postTypeSlug,
        string $plural,
        array $labels = []
    ) {
        $this->types[$label] = new \Moehrenzahn\Toolkit\Model\TaxonomyType(
            $label,
            $postTypeSlug,
            $plural,
            $labels
        );
    }

    /**
     * @return Model\TaxonomyType[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }
}
