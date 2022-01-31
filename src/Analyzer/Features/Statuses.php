<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;
use SvnStatify\Collection\Status;

/**
 * @property array $statistic
 */
class Statuses extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 5;

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'statuses';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about changes on every svn status.';
    }

    /**
     * {@inheritdoc}
     */
    protected function analyzeRevision(Revision $revision) : void
    {
        $changes = $revision->getChanges();
        while ($changes->valid()) {
            $change = $changes->current();
            $status = $change->getStatus();
            if (!isset(Status::list()[$status->getSymbol()])) {
                $changes->next();

                continue;
            }
            $statusRepresent = $status->represent();
            if (array_key_exists($statusRepresent, $this->statistic)) {
                ++$this->statistic[$statusRepresent];
            } else {
                $this->statistic[$statusRepresent] = 1;
            }

            $changes->next();
        }

        $changes->rewind();
    }
}
