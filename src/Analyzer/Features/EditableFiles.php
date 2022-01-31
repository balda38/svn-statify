<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

/**
 * @property array $statistic
 */
class EditableFiles extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 30;

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'editableFiles';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display the most editable files.';
    }

    /**
     * {@inheritdoc}
     */
    protected function analyzeRevision(Revision $revision) : void
    {
        $changes = $revision->getChanges();
        while ($changes->valid()) {
            $change = $changes->current();
            $path = $change->path;

            // Branches changes (e.g. svn ignore) isn't interesting
            $pathElements = explode('/', $path);
            if (count($pathElements) <= 2) {
                $changes->next();

                continue;
            }
            $isTrunk = $pathElements[1] === 'trunk';
            if (!$isTrunk && count($pathElements) <= 3) {
                $changes->next();

                continue;
            }

            if (array_key_exists($path, $this->statistic)) {
                ++$this->statistic[$path];
            } else {
                $this->statistic[$path] = 1;
            }

            $changes->next();
        }

        $changes->rewind();
    }
}
