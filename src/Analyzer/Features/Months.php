<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

use SvnStatify\Analyzer\AnalyzerResultItem;

class Months extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 5;

    private $monthsStat = [];

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'months';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display month date ranges with most number of commits.';
    }

    /**
     * {@inheritdoc}
     */
    public function analyzeRevision(Revision $revision) : void
    {
        $month = $revision->dateTime->format('F Y');
        if (array_key_exists($month, $this->monthsStat)) {
            ++$this->monthsStat[$month];
        } else {
            $this->monthsStat[$month] = 1;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function finishAnalyze() : void
    {
        arsort($this->monthsStat);
        $this->monthsStat = array_slice($this->monthsStat, 0, self::MAX_COUNT);

        foreach ($this->monthsStat as $month => $commits) {
            $analyzerResultItem = new AnalyzerResultItem();
            $analyzerResultItem->key = $month;
            $analyzerResultItem->numberOfCommits = $commits;
            $this->analyzerResult->addItem($analyzerResultItem);
        }
    }
}
