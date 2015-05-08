<?php
namespace Dbgp\Input;

use Dbgp\InputCommand;
use Dbgp\Response\MessageInterface;

/**
 * Class AbstractInput
 * @package Dbgp\Input
 */
abstract class AbstractInput implements InputInterface
{
    const COMMAND_NAME = 'command';

    /**
     * @var InputCommand
     */
    private $command;

    /**
     * @param InputCommand $cmd
     */
    public function __construct(InputCommand $cmd)
    {
        $this->command = $cmd;
    }

    /**
     * @return InputCommand
     */
    protected function getCommand()
    {
        return $this->command;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->getCommand()->getOption('i');
    }

    /**
     * @return \Dbgp\Response\MessageInterface|\Dbgp\Serialize\SerializableInterface|\Dbgp\Serialize\Xml\RootNode|null
     */
    public function getResponse()
    {
        return null;
    }

    /**
     * @return string
     */
    public static function getCommandName()
    {
        return static::COMMAND_NAME;
    }
}
