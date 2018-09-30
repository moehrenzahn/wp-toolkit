<?php
namespace Toolkit\Model\AdminPage\Settings\Setting;

use Toolkit\Model\AdminPage\Settings\Setting;
use Toolkit\Block\Settings\Setting as SettingBlock;

/**
 * Class Select
 *
 * @package Toolkit\AdminPage\Settings\Setting
 */
class Select extends Setting
{
    /**
     * string[]
     */
    private $options = [];

    /**
     * Select constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $description
     * @param string[] $options
     * @param SettingBlock $block
     */
    public function __construct(
        $id,
        $title,
        $description,
        $options,
        SettingBlock $block
    ) {
        $this->options = $options;

        parent::__construct($id, $title, $description, $block);
    }

    /**
     * @return string[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
