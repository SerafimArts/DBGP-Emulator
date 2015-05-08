<?php
namespace Dbgp\Debugger;

/**
 * Class Log
 * @package Dbgp\Debugger
 */
class Log
{
    /**
     * @param $message
     */
    public static function write($message)
    {
        echo $message;
        flush();
    }

    /**
     * @param $message
     */
    public static function writeln($message)
    {
        echo $message . "\n\n";
        flush();
    }
}
