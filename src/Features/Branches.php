<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

use SplObjectStorage;

class Branches extends BaseFeautre
{
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
    public function analyzeRevision(Revision $revision) : void
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getAnalyzeResult()
    {

    }
}
