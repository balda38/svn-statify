<?php

namespace SvnStatify\Parser;

use SvnStatify\Parser\Validators\RevisionValidator;

use SvnStatify\Exception\InvalidLogFileException;

use SvnStatify\Collection\Repository;
use SvnStatify\Collection\Revision;
use SvnStatify\Collection\Change;

use Exception;
use DateTime;
use DateTimeZone;
use SimpleXMLElement;

use function date_default_timezone_get;

class Parser
{
    /**
     * @var SimpleXMLElement
     */
    private $data;
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(SimpleXMLElement $data)
    {
        $this->data = $data;
        $this->repository = new Repository();
    }

    public static function run() : Repository
    {
        $data = ParsedFile::getData();
        $parser = new self($data);
        $parser->process();

        return $parser->repository;
    }

    /**
     * @throws InvalidLogFileException
     */
    private function process() : void
    {
        $timezone = new DateTimeZone(date_default_timezone_get());

        $parsedRevisions = 0;
        foreach ($this->data as $rawRevision) {
            try {
                RevisionValidator::validate($rawRevision);
            } catch (Exception $e) {
                // just check next revision
                continue;
            }

            $revision = new Revision();
            $revision->number = (int) $rawRevision->attributes()->revision;
            $revision->author = (string) $rawRevision->author;
            $dateTime = new DateTime((string) $rawRevision->date);
            $dateTime->setTimezone($timezone);
            $revision->dateTime = $dateTime;
            $revision->message = (string) $rawRevision->msg;

            foreach ($rawRevision->paths->path as $path) {
                $change = new Change();
                $change->path = (string) $path;
                $change->setStatus($path->attributes()->action);

                $revision->addChange($change);
            }

            $this->repository->addRevision($revision);
            ++$parsedRevisions;
        }

        if ($parsedRevisions === 0) {
            throw new InvalidLogFileException();
        }
    }
}
