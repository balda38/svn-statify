<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

use SplObjectStorage;

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
    public function getAnalyzeResult()
    {

    }
}
