<?php
namespace Dbgp\Response;

use Dbgp\Debugger;
use Dbgp\Serialize\DbgpMessage;
use Dbgp\Serialize\Xml\RootNode;

/**
 * Class InitMessage
 * @package Dbgp\Message
 *
 * @property string $file
 */
class InitMessage extends AbstractMessage
{
    /**
     * @var string
     */
    protected $file = __FILE__;

    /**
     * @var string
     */
    protected $ideKey = '';

    /**
     * @param $file
     */
    public function __construct($file, $ideKey)
    {
        $this->file = str_replace('\\', '/', $file);
        $this->ideKey = $ideKey;
    }

    /**
     * @return \Dbgp\Serialize\SerializableInterface|RootNode
     */
    public function getData()
    {
        $root = new RootNode('init');
        $root->addAttribute('xmlns',            'urn:debugger_protocol_v1');
        $root->addAttribute('fileuri',          'file:///' . $this->file);
        $root->addAttribute('language',         'PHP');
        $root->addAttribute('protocol_version', '1.0');
        $root->addAttribute('appid',            '13468');
        $root->addAttribute('idekey',           $this->ideKey);

        $engine = $root->addNode('engine');
        $engine->addAttribute('version', Debugger::VERSION);
        $engine->setValue(Debugger::NAME);

        $author = $root->addNode('author');
        $author->setValue('Nesmeyanov Kirill');

        $url = $root->addNode('url');
        $url->setValue('http://jphp.ru');

        $copyright = $root->addNode('copyright');
        $copyright->setValue('Copyright (c) 2015 by Nesmeyanov Kirill');

        return $root;
    }
}
