<?php

namespace SvnStatify\Features;

interface IFeature
{
    /**
     * Get name of feature for display in report.
     */
    public static function getName() : string;

    /**
     * Get description of feature for display in `--help`.
     */
    public static function getDescription() : string;
}
