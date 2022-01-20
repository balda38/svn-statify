<?php

require_once __DIR__.'/vendor/autoload.php';

$statify = new SvnStatify\SvnStatify($argv[1]);
$statify->outputSimple();
