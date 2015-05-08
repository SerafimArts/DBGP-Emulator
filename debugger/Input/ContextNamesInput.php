<?php
namespace Dbgp\Input;

use Dbgp\Response\ResponseMessage;


/**
 * Class ContextNamesInput
 * @package Dbgp\Input
 */
class ContextNamesInput extends AbstractInput
{
    const COMMAND_NAME = 'context_names';

    /**
     * @TODO Not working yet
     * @return \Dbgp\Response\MessageInterface|\Dbgp\Serialize\SerializableInterface|\Dbgp\Serialize\Xml\RootNode|null
     */
    public function getResponse()
    {
        $cmd = $this->getCommand();

        $root = (new ResponseMessage($cmd->getOption('i'), self::COMMAND_NAME))
            ->getData();

        $root->addAttributes([
            'status' => 'break',
            'reason' => 'ok'
        ]);


        ///// ============= /////
        $root
            ->addNode('context')
            ->addAttributes([
                'name' => 'Locals',
                'id' => 0
            ]);

        $root
            ->addNode('context')
            ->addAttributes([
                'name' => 'Superglobals',
                'id' => 1
            ]);

        $root
            ->addNode('context')
            ->addAttributes([
                'name' => 'User defined constants',
                'id' => 2
            ]);
        ///// ============= /////


        return $root;
    }
}
