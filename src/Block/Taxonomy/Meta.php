<?php
namespace Toolkit\Block\Taxonomy;

use Toolkit\Block;
use Toolkit\ImageSize;
use Toolkit\Javascript;
use Toolkit\TaxonomyMetaAccessor;

/**
 * Class Meta
 *
 * @package Toolkit\Block\Taxonomy
 */
class Meta extends Block
{
    /**
     * @var TaxonomyMetaAccessor
     */
    private $metaAccessor;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var int|null
     */
    private $termId;

    /**
     * Meta constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param TaxonomyMetaAccessor $metaAccessor
     * @param string $templatePath
     * @param string $slug
     * @param \WP_Post|null $post
     * @param array $data
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        TaxonomyMetaAccessor $metaAccessor,
        string $templatePath,
        string $slug,
        \WP_Post $post = null,
        $data = []
    ) {
        $this->metaAccessor = $metaAccessor;
        $this->slug = $slug;

        parent::__construct($javascript, $imageSize, $templatePath, $post, $data);
    }


    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return bool|string|int
     */
    public function getValue()
    {
        if ($this->termId && $this->slug) {
            $value = $this->metaAccessor->getValue($this->termId, $this->slug);
        }

        return $value ?? false;
    }

    /**
     * @param int $termId
     */
    public function setTermId($termId)
    {
        $this->termId = $termId;
    }
}
