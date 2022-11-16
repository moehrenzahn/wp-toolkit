<?php

namespace Moehrenzahn\Toolkit\Model\Action;

use Moehrenzahn\Toolkit\TaxonomyMetaAccessor;

/**
 * Class TermMetaSave
 *
 * Save controller for use in hook edited_$taxonomy.
 *
 * @url https://codex.wordpress.org/Plugin_API/Action_Reference/edited_$taxonomy
 * @package Moehrenzahn\Toolkit\Model\Action
 */
class TermMetaSave
{
    /**
     * @var TaxonomyMetaAccessor
     */
    private $metaAccessor;

    /**
     * TermMetaSave constructor.
     *
     * @param TaxonomyMetaAccessor $metaAccessor
     */
    public function __construct(TaxonomyMetaAccessor $metaAccessor)
    {
        $this->metaAccessor = $metaAccessor;
    }

    /**
     * Save a slug value from the $_POST request.
     *
     * @param mixed[] $request
     * @param string $termId
     * @param string $slug
     */
    public function doSaveAction(array $request, string $termId, string $slug)
    {
        if (isset($request[$slug])) {
            $this->metaAccessor->setValue($termId, $slug, $request[$slug]);
        } else {
            $this->metaAccessor->setValue($termId, $slug, false);
        }
    }
}
