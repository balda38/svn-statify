<?php

namespace SvnStatify\Analyzer;

class AnalyzerResult
{
    /**
     * @var string
     */
    public $feature;
    /**
     * @var AnalyzerResultItem[]
     */
    private $items = [];

    public function __construct(string $feature)
    {
        $this->feature = $feature;
    }

    public function addItem(AnalyzerResultItem $item) : void
    {
        $this->items[] = $item;
    }

    public function getItems() : array
    {
        return $this->items;
    }
}
