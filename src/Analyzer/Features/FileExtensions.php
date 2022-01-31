<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

/**
 * @property array $statistic
 */
class FileExtensions extends BaseFeature
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
        return 'fileExtensions';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about most editable file extensions.';
    }

    /**
     * {@inheritdoc}
     */
    protected function analyzeRevision(Revision $revision) : void
    {
        $changes = $revision->getChanges();
        while ($changes->valid()) {
            $change = $changes->current();
            $pathInfo = pathinfo($change->path);
            if (isset($pathInfo['extension'])) {
                $extension = $pathInfo['extension'];
                if (array_key_exists($extension, $this->statistic)) {
                    ++$this->statistic[$extension];
                } else {
                    $this->statistic[$extension] = 1;
                }
            }

            $changes->next();
        }

        $changes->rewind();
    }
}
