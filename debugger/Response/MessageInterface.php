<?php
namespace Dbgp\Response;

use Dbgp\Serialize\DbgpMessage;
use Dbgp\Serialize\SerializableInterface;

/**
 * Interface MessageInterface
 * @package Dbgp\Message
 */
interface MessageInterface
{
    /**
     * @return SerializableInterface
     */
    public function getData();
}
