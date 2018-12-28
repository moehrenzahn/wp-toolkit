<?php

namespace Toolkit\Model\Post;

/**
 * Generic Preference Item
 *
 * @package Eule\Model\Preference
 */
interface PreferenceInterface
{
    /**
     * @param string $value
     * @param null|int $postId
     */
    public function setValue(string $value, $postId = null);

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return mixed
     */
    public function getValue();
}
