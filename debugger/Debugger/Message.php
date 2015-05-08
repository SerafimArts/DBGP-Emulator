<?php
namespace Dbgp\Debugger;

class Message
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function toString()
    {
        return strlen($this->text) . "\000" . $this->text . "\000";
    }
}
