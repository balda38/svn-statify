<?php

namespace SvnStatify\Parser;

use SvnStatify\Exception\EmptyLogFileException;
use SvnStatify\Exception\LogFileNotFoundException;

use SimpleXMLElement;

use function simplexml_load_file;
use function sys_get_temp_dir;

class ParsedFile
{
    /**
     * File name, where stored data from `svn log`.
     */
    const NAME = 'svn-statify_svn_log.xml';

    /**
     * @return string path to file, where stored data from `svn log`
     */
    public static function getPath() : string
    {
        return sys_get_temp_dir().'/'.self::NAME;
    }

    /**
     * @throws LogFileNotFoundException
     * @throws EmptyLogFileException
     */
    public static function getData() : SimpleXMLElement
    {
        $pathToFile = self::getPath();
        if (!is_file($pathToFile)) {
            throw new LogFileNotFoundException();
        }

        $data = simplexml_load_file($pathToFile);
        if ($data->count() === 0) {
            throw new EmptyLogFileException();
        }

        return $data;
    }
}
