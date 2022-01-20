<?php

namespace SvnStatify\Features;

class Maintainers
{
    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'maintainers';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about all maintainers with common count of their commits.';
    }
}
