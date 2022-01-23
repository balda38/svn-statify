<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

use Balda38\ProgressBario;

use SplObjectStorage;

/**
 * Analyzing repository revisions on features.
 */
class Analyzer
{
    /**
     * @param SplObjectStorage<Revision>
     */
    public static function run(SplObjectStorage $revisions) : array
    {
        // 2 - is number of features
        $progress = new ProgressBario($revisions->count() * 2, 'Analyzing repository', true);

        $result = [];
        foreach ([
            Maintainers::class,
            Words::class
        ] as $featureClass) {
            $feature = new $featureClass();
            foreach ($feature->processRevisions($revisions) as $revision) {
                $feature->analyzeRevision($revision);

                $progress->makeStep();
            }
            $result[$feature->getName()] = $feature->getAnalyzeResult();
        }

        $progress->close();

        return $result;
    }
}
