<?php

namespace SvnStatify\Analyzer;

use SvnStatify\Collection\Repository;

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

        // 2 - is number of features
        $progress = new ProgressBario($revisions->count() * 2, 'Analyzing repository', true);

        $result = [];
        foreach ([
            Maintainers::class,
            Months::class,
            Words::class,
        ] as $featureClass) {
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
