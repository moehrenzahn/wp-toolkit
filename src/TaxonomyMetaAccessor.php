<?php

namespace Toolkit;

/**
 * Class TaxonomyMetaAccessor
 *
 * @package Toolkit
 */
class TaxonomyMetaAccessor
{
    /**
     * @param string $termId
     * @param string $slug
     * @return mixed
     */
    public function getValue(string $termId, string $slug)
    {
        return get_term_meta(
            $termId,
            $slug,
            true
        );
    }

    public function setValue(string $termId, string $slug, $value)
    {
        add_term_meta($termId, $slug, $value, true);
        update_term_meta($termId, $slug, $value);
    }
}
