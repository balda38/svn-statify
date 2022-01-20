<?php

namespace SvnStatify\Features;

class Words
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
}
