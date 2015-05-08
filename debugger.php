<?php

use Dbgp\Debugger;

require __DIR__ . '/vendor/autoload.php';

$debugger = new Debugger(9000);
$debugger->run('D:/@projects/Xdebug/debugger/Browser.php', 'PHPSTORM');
