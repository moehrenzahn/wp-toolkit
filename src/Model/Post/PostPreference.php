<?php

namespace Moehrenzahn\Toolkit\Model\Post;

use Moehrenzahn\Toolkit\Model\Post\Storage\StorageInterface;

/**
 * Class PostPreference
 *
 * @package Toolkit
 */
class PostPreference implements PreferenceInterface
{
    const TYPE_TEXT = 'Text';
    const TYPE_TEXTAREA = 'Textarea';
    const TYPE_BOOLEAN = 'Boolean';
    const TYPE_SELECT = 'Select';
    const TYPE_RADIO = 'Radio';
    const TYPE_MEDIA = 'Media';

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string[]|null
     */
    public $options;

    /**
     * @var string
     */
    public $type;

    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * PostPreference constructor.
     *
     * @param string $title
     * @param string $slug
     * @param string $description
     * @param string $type
     * @param StorageInterface $storage
     * @param string[]|null $options
     */
    public function __construct(
        string $title,
        string $slug,
        string $description,
        string $type,
        StorageInterface $storage,
        $options = null
    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->description = $description;
        $this->type = $type;
        $this->storage = $storage;
        $this->options = $options;
    }

    /**
     * @param int $postId
     * @param bool|string $value
     */
    public function setValue(string $value, $postId = null)
    {
        $this->storage->update($this, $value, $postId);
    }

    /**
     * @param int $postId
     * @return bool|null|string
     */
    public function getValue($postId = null)
    {
        return $this->storage->load($this, $postId);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return null|string[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
