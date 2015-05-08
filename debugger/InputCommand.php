<?php
namespace Dbgp;

use LogicException;

/**
 * Class InputCommand
 * @package Dbgp
 */
class InputCommand
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @param $opt
     * @return mixed
     */
    public function getOption($opt)
    {
        $pattern = '/-' . preg_quote($opt) . '\s(\w+)\s*/';
        preg_match_all($pattern, $this->message, $m);

        if (!isset($m[1])) {
            throw new LogicException('Unknown option "-' . $opt . '"');
        }

        return $m[1][0];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        $pattern = '/^(.*?)\s/';
        preg_match_all($pattern, $this->message, $m);

        if (!isset($m[1])) {
            throw new LogicException('Undefined request message "' . $this->message . '"');
        }

        return $m[1][0];
    }
}
