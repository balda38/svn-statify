<?php

namespace SvnStatify\Parser;

class Parser
{
    /**
     * Path to file, where stored data from `svn log`.
     */
    const FILE_NAME_FOR_COLLECT = 'svn-statify_svn_log.xml';

    public static function run()
    {
        $data = simplexml_load_file(self::getPathToFileForCollect());
    }

    /**
     * @return string path to file, where stored data from `svn log`
     */
    public static function getPathToFileForCollect() : string
    {
        return sys_get_temp_dir().'/'.self::FILE_NAME_FOR_COLLECT;
    }
}
