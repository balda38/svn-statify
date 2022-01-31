<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

use SvnStatify\Analyzer\AnalyzerResultItem;

/**
 * @property SvnStatify\Analyzer\AnalyzerResult $analyzerResult
 */
class Words extends BaseFeature
{
    /**
     * @todo It's should be configured param
     */
    const MAX_COUNT = 30;

    private $mostCommonWords = [];

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'words';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDescription() : string
    {
        return 'Display the most common words in commit messages.';
    }

    /**
     * {@inheritdoc}
     */
    protected function analyzeRevision(Revision $revision) : void
    {
        $messageWords = preg_split('/\s+/', $revision->message);
        foreach ($messageWords as $word) {
            // Skip pretexts - not interesting
            if (mb_strlen($word) <= 3) {
                continue;
            }
            if (array_key_exists($word, $this->mostCommonWords)) {
                ++$this->mostCommonWords[$word];
            } else {
                $this->mostCommonWords[$word] = 1;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function finishAnalyze() : void
    {
        arsort($this->mostCommonWords);
        $this->mostCommonWords = array_slice($this->mostCommonWords, 0, self::MAX_COUNT);

        foreach ($this->mostCommonWords as $word => $count) {
            $analyzerResultItem = new AnalyzerResultItem();
            $analyzerResultItem->key = $word;
            $analyzerResultItem->numberOfCommits = $count;
            $this->analyzerResult->addItem($analyzerResultItem);
        }
    }
}
