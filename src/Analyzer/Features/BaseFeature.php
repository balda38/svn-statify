<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Analyzer\AnalyzerResult;
use SvnStatify\Collection\Revision;

use SplObjectStorage;

abstract class BaseFeature
{
    /**
     * @var AnalyzerResult
     */
    protected $analyzerResult;

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
    abstract public function analyzeRevision(Revision $revision) : void;

    /**
     * End the process of analyze feature. Here must fill $this->analyzerResult.
     */
    abstract protected function finishAnalyze() : void;

    /**
     * Get the result of revisions analyzing.
     */
    final public function getAnalyzerResult() : AnalyzerResult
    {
        $this->finishAnalyze();

        return $this->analyzerResult;
    }

    /**
     * @param SplObjectStorage<Revision>
     */
    final public function processRevisions(SplObjectStorage $revisions)
    {
        while ($revisions->valid()) {
            yield $revisions->current();

            $revisions->next();
        }

        $revisions->rewind();
    }
}
