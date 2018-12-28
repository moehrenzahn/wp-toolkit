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
     * @var string
     */
    private $title;
    /**
     * @var string[]
     */
    private $options;
    /**
     * @var string
     */
    private $description;

    /**
     * @var int|null
     */
    private $termId;

    /**
     * Meta constructor.
     *
     * @param Javascript $javascript
     * @param ImageSize $imageSize
     * @param Block\BlockFactory $blockFactory
     * @param TaxonomyMetaAccessor $metaAccessor
     * @param string $templatePath
     * @param string $slug
     * @param string $title
     * @param string[] $options
     * @param string $description
     */
    public function __construct(
        Javascript $javascript,
        ImageSize $imageSize,
        Block\BlockFactory $blockFactory,
        TaxonomyMetaAccessor $metaAccessor,
        string $templatePath,
        string $slug,
        string $title,
        array $options,
        string $description
    ) {
        $this->metaAccessor = $metaAccessor;
        $this->slug = $slug;
        $this->title = $title;
        $this->options = $options;
        $this->description = $description;

        parent::__construct($javascript, $imageSize, $blockFactory, $templatePath);
    }


    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
