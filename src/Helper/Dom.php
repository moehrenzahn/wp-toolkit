<?php

namespace Moehrenzahn\Toolkit\Helper;

/**
 * Class Dom
 *
 * @package Moehrenzahn\Toolkit\Helper
 */
class Dom
{
    /**
     * @var int[][]    Name of the DOM => [Target positions of injected items]
     */
    private $injectedItems;

    /**
     * @param string $html
     * @return \DOMDocument
     */
    public function domFromHtml(string $html): \DOMDocument
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $contentForDOM = mb_convert_encoding(
            $html,
            'HTML-ENTITIES',
            'UTF-8'
        );
        /**
         * Added <html> tag is a workaround for a SimpleXML bug
         * @url http://php.net/manual/de/domdocument.savehtml.php#121444
         */
        @ $dom->loadHtml(
            '<html>'.$contentForDOM.'</html>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        return $dom;
    }

    /**
     * @param \DOMDocument $dom
     * @return string
     */
    public function htmlFromDom(\DOMDocument $dom): string
    {
        return str_replace(
            ['<html>','</html>'],
            '',
            $dom->saveHTML()
        );
    }

    /**
     * Insert $html string into a $targetDom at the specified node $position. Will increase $position
     * by 3 if there previously was an item added to the same index.
     *
     * @param \DOMDocument $targetDom
     * @param string $html
     * @param int $position
     */
    public function insertHtmlAtPosition(\DOMDocument $targetDom, string $html, int $position = 3)
    {
        $domId = $this->generateDomId($targetDom);
        if (isset($this->injectedItems[$domId]) && in_array($position, $this->injectedItems[$domId])) {
            $position = $position + 5;
        }
        $htmlDom = $this->domFromHtml($html);
        $targetDom->documentElement->insertBefore(
            $targetDom->importNode($htmlDom->documentElement, true),
            $targetDom->documentElement->childNodes->item($position)
        );

        $this->injectedItems[$domId][] = $position;
    }

    /**
     * Similar to insertHtmlAtPosition,
     * but will add the html to just before a h2 tag.
     *
     * @param \DOMDocument $targetDom
     * @param string       $html
     * @param int          $position
     */
    public function insertHtmlAth2(\DOMDocument $targetDom, string $html, int $position = 2)
    {
        $position = $this->getPositionForh2($targetDom, $position);
        $this->insertHtmlAtPosition($targetDom, $html, $position);
    }

    /**
     * Generate an ID for a DOMDocument element
     *
     * @param \DOMDocument $dom
     * @return string
     */
    private function generateDomId(\DOMDocument $dom): string
    {
        return md5(substr($dom->textContent, 0, 25));
    }

    /**
     * Find the position just before a <h2> element.
     *
     * @param \DOMDocument $dom
     * @param int $number
     * @return int
     */
    private function getPositionForh2(\DOMDocument $dom, int $number): int
    {
        $position = 0;
        $numberOfH2s = 0;
        foreach ($dom->documentElement->childNodes as $node) {
            if ($node->tagName === 'h2') {
                $numberOfH2s++;
            }
            if ($numberOfH2s >= $number) {
                break;
            }
            $position++;
        }

        return $position;
    }
}
