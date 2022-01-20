<?php

namespace SvnStatify\Features;

class FileExtension
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
}
