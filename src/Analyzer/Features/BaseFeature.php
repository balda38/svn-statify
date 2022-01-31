<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Analyzer\AnalyzerResult;
use SvnStatify\Analyzer\AnalyzerResultItem;

use SvnStatify\Collection\Revision;

use SplObjectStorage;

abstract class BaseFeature
{
    /**
     * @var AnalyzerResult
     */
    private $analyzerResult;
    /**
     * @var array
     */
    protected $statistic = [];

    public function __construct()
    {
        $this->analyzerResult = new AnalyzerResult(static::getName());
    }

    /**
     * Get name of feature for display in report.
     */
    abstract public static function getName() : string;

    /**
     * Get description of feature for display in `--help`.
     */
    abstract public static function getDescription() : string;

    /**
     * Run analyze on specific revision for feature.
     */
    abstract protected function analyzeRevision(Revision $revision) : void;

    /**
     * Get the result of revisions analyzing.
     */
    final public function getAnalyzerResult() : AnalyzerResult
    {
        $statistic = $this->statistic;
        arsort($statistic);
        $statistic = array_slice($statistic, 0, static::MAX_COUNT);

        foreach ($statistic as $statisticKey => $commits) {
            $analyzerResultItem = new AnalyzerResultItem();
            $analyzerResultItem->key = $statisticKey;
            $analyzerResultItem->numberOfCommits = $commits;
            $this->analyzerResult->addItem($analyzerResultItem);
        }

        return $this->analyzerResult;
    }

    /**
     * @param SplObjectStorage<Revision>
     */
    final public function processRevisions(SplObjectStorage $revisions)
    {
        while ($revisions->valid()) {
            static::analyzeRevision($revisions->current());
            $revisions->next();
        }
        $revisions->rewind();
    }
}
