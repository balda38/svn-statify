<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

use SvnStatify\Analyzer\AnalyzerResultItem;

/**
 * @property SvnStatify\Analyzer\AnalyzerResult $analyzerResult
 */
class Maintainers extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 5;

    private $maintainersStat = [];

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'maintainers';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about all maintainers with common count of their commits.';
    }

    /**
     * {@inheritdoc}
     */
    protected function analyzeRevision(Revision $revision) : void
    {
        if (array_key_exists($revision->author, $this->maintainersStat)) {
            ++$this->maintainersStat[$revision->author];
        } else {
            $this->maintainersStat[$revision->author] = 1;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function finishAnalyze() : void
    {
        arsort($this->maintainersStat);
        $this->maintainersStat = array_slice($this->maintainersStat, 0, self::MAX_COUNT);

        foreach ($this->maintainersStat as $maintainer => $commits) {
            $analyzerResultItem = new AnalyzerResultItem();
            $analyzerResultItem->key = $maintainer;
            $analyzerResultItem->numberOfCommits = $commits;
            $this->analyzerResult->addItem($analyzerResultItem);
        }
    }
}
