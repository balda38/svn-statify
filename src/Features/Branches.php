<?php

namespace SvnStatify\Features;

class Branches
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
}
