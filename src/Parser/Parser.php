<?php

namespace SvnStatify\Parser;

use SvnStatify\Collection\Repository;
use SvnStatify\Collection\Revision;
use SvnStatify\Collection\Change;

use SvnStatify\Exception\LogFileNotFoundException;

use DateTime;
use DateTimeZone;
use SimpleXMLElement;

use function simplexml_load_file;
use function sys_get_temp_dir;
use function date_default_timezone_get;

class Parser
{
    /**
     * Path to file, where stored data from `svn log`.
     */
    const FILE_NAME_FOR_COLLECT = 'svn-statify_svn_log.xml';

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

    /**
     * @throws LogFileNotFoundException
     */
    public static function run() : Repository
    {
        $pathToFile = self::getPathToFileForCollect();
        if (!is_file($pathToFile)) {
            throw new LogFileNotFoundException();
        }

        $data = simplexml_load_file(self::getPathToFileForCollect());
        $parser = new self($data);
        $parser->process();

        return $parser->repository;
    }

    /**
     * @return string path to file, where stored data from `svn log`
     */
    public static function getPathToFileForCollect() : string
    {
        return sys_get_temp_dir().'/'.self::FILE_NAME_FOR_COLLECT;
    }

    private function process() : void
    {
        $timezone = new DateTimeZone(date_default_timezone_get());

        foreach ($this->data as $rawRevision) {
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
        }
    }
}
