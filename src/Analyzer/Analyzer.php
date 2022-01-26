<?php

namespace SvnStatify\Analyzer;

use SvnStatify\Collection\Repository;

use SvnStatify\Analyzer\Features\FileExtensions;
use SvnStatify\Analyzer\Features\Maintainers;
use SvnStatify\Analyzer\Features\Months;
use SvnStatify\Analyzer\Features\Words;

use Balda38\ProgressBario;

/**
 * Analyzing repository revisions on features.
 */
class Analyzer
{
    public static function run(Repository $repository) : array
    {
        $revisions = $repository->getRevisions();
        $features = [
            Maintainers::class,
            Months::class,
            Words::class,
            FileExtensions::class,
        ];

        $progress = new ProgressBario($revisions->count() * count($features), 'Analyzing repository', true);

        $result = [];
        foreach ($features as $featureClass) {
            $feature = new $featureClass();
            foreach ($feature->processRevisions($revisions) as $revision) {
                $feature->analyzeRevision($revision);

                $progress->makeStep();
            }
            $result[] = $feature->getAnalyzerResult();
        }

        $progress->close();

        return $result;
    }
}
