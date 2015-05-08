<?php
namespace Dbgp\Response;

use Dbgp\Serialize\Xml\RootNode;

/**
 * Class ResponseMessage
 * @package Dbgp\Message
 */
class ResponseMessage extends AbstractMessage
{
    /**
     * @var int
     */
    protected static $id = 0;

    /**
     * @var string
     */
    protected $command;

    /**
     * @var mixed
     */
    protected $transactionId;

    /**
     * @param $command
     */
    public function __construct($transactionId, $command)
    {
        $this->command = $command;
        $this->transactionId = $transactionId;
    }

    /**
     * @return \Dbgp\Serialize\SerializableInterface|RootNode
     */
    public function getData()
    {
        $root = new RootNode('response');
        $root->addAttribute('xmlns',            'urn:debugger_protocol_v1');
        $root->addAttribute('xmlns:xdebug',     'http://xdebug.org/dbgp/xdebug');
        $root->addAttribute('id',               self::$id++);
        $root->addAttribute('command',          $this->command);
        $root->addAttribute('transaction_id',   $this->transactionId);

        return $root;
    }
}
