<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

/**
 * @property array $statistic
 */
class Maintainers extends BaseFeature
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
        if (array_key_exists($revision->author, $this->statistic)) {
            ++$this->statistic[$revision->author];
        } else {
            $this->statistic[$revision->author] = 1;
        }
    }
}
