<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

use SplObjectStorage;

class Words extends BaseFeature
{
    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'words';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display the most common words in commit messages.';
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
