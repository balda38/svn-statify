<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

use SvnStatify\Analyzer\AnalyzerResultItem;

class FileExtensions extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 5;

    private $fileExtensionsStat = [];

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
    public function analyzeRevision(Revision $revision) : void
    {
        $changes = $revision->getChanges();
        while ($changes->valid()) {
            $change = $changes->current();
            $pathInfo = pathinfo($change->path);
            if (isset($pathInfo['extension'])) {
                $extension = $pathInfo['extension'];
                if (array_key_exists($extension, $this->fileExtensionsStat)) {
                    ++$this->fileExtensionsStat[$extension];
                } else {
                    $this->fileExtensionsStat[$extension] = 1;
                }
            }

            $changes->next();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function finishAnalyze() : void
    {
        arsort($this->fileExtensionsStat);
        $this->fileExtensionsStat = array_slice($this->fileExtensionsStat, 0, self::MAX_COUNT);

        foreach ($this->fileExtensionsStat as $extension => $commits) {
            $analyzerResultItem = new AnalyzerResultItem();
            $analyzerResultItem->key = $extension;
            $analyzerResultItem->numberOfCommits = $commits;
            $this->analyzerResult->addItem($analyzerResultItem);
        }
    }
}
