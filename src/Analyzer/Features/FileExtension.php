<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

class FileExtension extends BaseFeature
{
    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'fileExtension';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about most editable file extensions.';
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
