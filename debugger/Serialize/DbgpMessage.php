<?php
namespace Dbgp\Serialize;

/**
 * Class DbgpMessage
 * @package Dbgp\Serialize
 */
class DbgpMessage implements SerializableInterface
{
    /**
     * @var string
     */
    protected $original;

    /**
     * @param SerializableInterface $original
     */
    public function __construct(SerializableInterface $original)
    {
        $this->original = $original->serialize();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return
            strlen($this->original) .
            "\000" .
                $this->original .
            "\000";
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->serialize();
    }
}
