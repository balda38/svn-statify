<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

class Month extends BaseFeature
{
    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'month';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display month date range with most number of commits.';
    }

    /**
     * {@inheritdoc}
     */
    public function analyzeRevision(Revision $revision) : void
    {

    }

    /**
     * {@inheritdoc}
     */
    public function finishAnalyze() : void
    {

    }
}
