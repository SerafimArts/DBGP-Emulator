<?php
namespace Dbgp\Response;

use Dbgp\Serialize\DbgpMessage;
use Dbgp\Serialize\SerializableInterface;

/**
 * Class AbstractMessage
 * @package Dbgp\Message
 */
abstract class AbstractMessage implements MessageInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (new DbgpMessage($this->getData()))
            ->serialize();
    }

    /**
     * @param $field
     * @param $value
     * @return null
     */
    public function __set($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        return null;
    }

    /**
     * @return SerializableInterface
     */
    abstract public function getData();
}
