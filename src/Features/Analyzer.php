<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

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
        $result = [];
        foreach ([
            Maintainers::class,
            Words::class
        ] as $featureClass) {
            $feature = new $featureClass();
            foreach ($feature->processRevisions($revisions) as $revision) {
                $feature->analyzeRevision($revision);
            }
            $result[$feature->getName()] = $feature->getAnalyzeResult();
        }

        return $result;
    }
}
