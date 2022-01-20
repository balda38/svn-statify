<?php

namespace SvnStatify\Features;

class Month
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
}
