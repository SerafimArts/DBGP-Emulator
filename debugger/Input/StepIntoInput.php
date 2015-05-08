<?php
namespace Dbgp\Input;

use Dbgp\Response\ResponseMessage;


/**
 * Class StepIntoInput
 * @package Dbgp\Input
 */
class StepIntoInput extends AbstractInput
{
    const COMMAND_NAME = 'step_into';

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

        $root
            ->addNode('xdebug:message')
            ->addAttributes([
                'filename' => '....',
                'lineno' => 0
            ]);

        return $root;
    }
}
