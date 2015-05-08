<?php
namespace Dbgp\Serialize\Xml;

use Dbgp\Serialize\SerializableInterface;

/**
 * Class Root
 * @package Dbgp\Serialize\Xml
 */
class Node implements SerializableInterface
{
    protected $name;
    protected $value;
    protected $attributes = [];
    protected $nodes = [];


    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param $name
     * @return Node
     */
    public function addNode($name)
    {
        $node = new Node($name);
        $this->nodes[] = $node;
        return $node;
    }

    /**
     * @param array<Node> $nodes
     * @return $this
     */
    public function addNodes(array $nodes)
    {
        foreach ($nodes as $node) {
            $this->nodes[] = $node;
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param array<String, String> $attributes
     * @return $this
     */
    public function addAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->addAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        if ($value) {
            $value = '<![CDATA[' . $value . ']]>';
        }
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributes[] = $key . '="' . $value . '"';
        }

        $nodes = [];
        foreach ($this->nodes as $node) {
            $nodes[] = $node->serialize();
        }

        $attr = '';
        if (count($attributes)) {
            $attr = ' ' . implode(' ', $attributes);
        }

        if (count($nodes) || $this->value) {
            $out  = '<' . $this->name . $attr . '>';
            $out .= $this->value;
            $out .= implode('', $nodes);
            $out .= '</' . $this->name . '>';

        } else {
            $out  = '<' . $this->name . $attr . '/>';
        }

        return $out;
    }
}
