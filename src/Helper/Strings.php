<?php

namespace Toolkit\Helper;

class Strings
{
    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return $length === 0 ||
            (substr($haystack, -$length) === $needle);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    /**
     * @param string $text
     * @param int $count
     * @param string $truncator
     * @return string
     */
    public static function trimToWords(string $text, int $count, string $truncator = '…'): string
    {
        $words = explode(' ', $text);
        if (count($words) > $count) {
            $words = array_slice($words, 0, $count);
            $words[] = $truncator;
        }
        return implode(' ', $words);
    }
}
