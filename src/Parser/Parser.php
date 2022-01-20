<?php

namespace SvnStatify\Parser;

use SvnStatify\SvnStatify;

class Parser
{
    public static function run()
    {
        $data = simplexml_load_file(SvnStatify::COLLECT_TO);
    }
}
