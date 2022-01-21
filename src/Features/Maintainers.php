<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

use SplObjectStorage;

class Maintainers extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 5;

    private $maintainersStat = [];

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'maintainers';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display data about all maintainers with common count of their commits.';
    }

    /**
     * {@inheritdoc}
     */
    public function analyzeRevision(Revision $revision) : void
    {
        if (array_key_exists($revision->author, $this->maintainersStat)) {
            ++$this->maintainersStat[$revision->author];
        } else {
            $this->maintainersStat[$revision->author] = 1;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAnalyzeResult()
    {
        arsort($this->maintainersStat);
        $this->maintainersStat = array_slice($this->maintainersStat, 0, 5);

        return $this->maintainersStat;
    }
}
