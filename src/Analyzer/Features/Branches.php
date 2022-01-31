<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

/**
 * @property array $statistic
 */
class Branches extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 5;

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'branches';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about number of created branches';
    }

    /**
     * {@inheritdoc}
     */
    protected function analyzeRevision(Revision $revision) : void
    {
        $changes = $revision->getChanges();
        $change = $changes->current(); // one change is enough
        $changePathElements = explode('/', $change->path);
        if (count($changePathElements) < 2) {
            return;
        }
        $isTrunk = $changePathElements[1] === 'trunk';
        // hmm... may be it's possible
        if (!$isTrunk && ($changePathElements[1] !== 'branches') || count($changePathElements) < 3) {
            return;
        }
        $branch = $isTrunk ? $changePathElements[1] : $changePathElements[2];
        if (array_key_exists($branch, $this->statistic)) {
            ++$this->statistic[$branch];
        } else {
            $this->statistic[$branch] = 1;
        }
    }
}
