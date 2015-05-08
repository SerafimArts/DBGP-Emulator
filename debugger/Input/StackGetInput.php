<?php
namespace Dbgp\Input;

use Dbgp\Response\ResponseMessage;


/**
 * Class StackGetInput
 * @package Dbgp\Input
 */
class StackGetInput extends AbstractInput
{
    const COMMAND_NAME = 'stack_get';

    /**
     * @TODO Not working yet
     * @return \Dbgp\Response\MessageInterface|\Dbgp\Serialize\SerializableInterface|\Dbgp\Serialize\Xml\RootNode|null
     */
    public function getResponse()
    {
        $cmd = $this->getCommand();

        $root = (new ResponseMessage($cmd->getOption('i'), self::COMMAND_NAME))
            ->getData();


        $root
            ->addNode('stack')
            ->addAttributes([
                'where'     => 'classname',
                'level'     => 0,
                'type'      => 'file',
                'filename'  => '.....',
                'lineno'    => 0
            ]);

        return $root;
    }
}
