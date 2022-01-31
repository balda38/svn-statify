<?php

namespace SvnStatify\Analyzer;

use SvnStatify\Collection\Repository;

use SvnStatify\Analyzer\Features\Branches;
use SvnStatify\Analyzer\Features\EditableFiles;
use SvnStatify\Analyzer\Features\FileExtensions;
use SvnStatify\Analyzer\Features\Maintainers;
use SvnStatify\Analyzer\Features\Months;
use SvnStatify\Analyzer\Features\Words;

/**
 * Analyzing repository revisions on features.
 */
class Analyzer
{
    /**
     * @return AnalyzerResult[]
     */
    public static function run(Repository $repository) : array
    {
        $revisions = $repository->getRevisions();

        $result = [];
        foreach (self::getFeatures() as $featureClass) {
            $feature = new $featureClass();
            $feature->processRevisions($revisions);
            $result[] = $feature->getAnalyzerResult();
        }

        return $result;
    }

    /**
     * @return string[]
     */
    public static function getFeatures() : array
    {
        return [
            Branches::class,
            EditableFiles::class,
            FileExtensions::class,
            Maintainers::class,
            Months::class,
            Words::class,
        ];
    }
}
