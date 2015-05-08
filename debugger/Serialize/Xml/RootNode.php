<?php
namespace Dbgp\Serialize\Xml;

use Dbgp\Serialize\SerializableInterface;

/**
 * Class RootNode
 * @package Dbgp\Serialize\Xml
 */
class RootNode extends Node implements SerializableInterface
{
    /**
     * @var float
     */
    public $version = 1.0;

    /**
     * @var string
     */
    public $encoding = 'iso-8859-1';


    /**
     * @return string
     */
    public function serialize()
    {
        $out  = '<?xml version="' . (number_format($this->version, 1)) . '" encoding="' . $this->encoding . '"?>' . "\n";
        $out .= parent::serialize();
        return $out;
    }
}
