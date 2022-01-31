<?php

namespace SvnStatify\Analyzer\Features;

use SvnStatify\Collection\Revision;

/**
 * @property array $statistic
 */
class Words extends BaseFeature
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
            if (array_key_exists($word, $this->statistic)) {
                ++$this->statistic[$word];
            } else {
                $this->statistic[$word] = 1;
            }
        }
    }
}
