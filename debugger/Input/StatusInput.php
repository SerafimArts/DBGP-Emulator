<?php
namespace Dbgp\Input;

use Dbgp\Response\ResponseMessage;

/**
 * Class StatusInput
 * @package Dbgp\Input
 */
class StatusInput extends AbstractInput
{
    const COMMAND_NAME = 'status';

    /**
     * @TODO Not working yet
     * @return \Dbgp\Serialize\SerializableInterface|\Dbgp\Serialize\Xml\RootNode
     */
    public function getResponse()
    {
        $cmd = $this->getCommand();

        $root = (new ResponseMessage($cmd->getOption('i'), self::COMMAND_NAME))
            ->getData();

        $root->addAttributes([
            'reason' => 'ok',
            'status' => 'starting'
        ]);

        return $root;
    }
}
