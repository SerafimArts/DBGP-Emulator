<?php
namespace Dbgp\Input;

use Dbgp\InputCommand;
use Dbgp\Response\MessageInterface;

/**
 * Interface InputInterface
 * @package Dbgp\Input
 */
interface InputInterface
{
    /**
     * @param InputCommand $cmd
     */
    public function __construct(InputCommand $cmd);

    /**
     * @return mixed
     */
    public function getTransactionId();

    /**
     * @return MessageInterface
     */
    public function getResponse();

    /**
     * @return string
     */
    public static function getCommandName();
}
