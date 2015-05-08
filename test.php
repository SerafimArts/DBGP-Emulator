<?php

use React\EventLoop\Factory;
use React\Socket\Connection;
use React\Socket\Server;

require __DIR__ . '/vendor/autoload.php';

$loop   = Factory::create();

$socket = new Server($loop);
$socket->on('connection', function (Connection $conn) {
    $i = 1;
    $conn->on('data', function ($data) use ($conn, &$i) {
        echo $data . "\n";
        echo str_repeat('=', 64) . "\n";

        if ($i%2) {
            $conn->write('step_into -i ' . ($i++) . "\000");
        } else {
            $conn->write('context_names -d 0 -i ' . ($i++) . "\000");
        }
    });
});
$socket->listen(9000);

$loop->run();

