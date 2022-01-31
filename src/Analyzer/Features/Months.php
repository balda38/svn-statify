<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

/**
 * @property array $statistic
 */
class Months extends BaseFeature
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
    protected function analyzeRevision(Revision $revision) : void
    {
        $month = $revision->dateTime->format('F Y');
        if (array_key_exists($month, $this->statistic)) {
            ++$this->statistic[$month];
        } else {
            $this->statistic[$month] = 1;
        }
    }
}
