<?php
namespace Dbgp;

use Dbgp\Debugger\Log;
use Dbgp\Input\ContextNamesInput;
use Dbgp\Input\FeatureSetInput;
use Dbgp\Input\StackGetInput;
use Dbgp\Input\StatusInput;
use Dbgp\Input\StepIntoInput;
use Dbgp\Response\InitMessage;
use Dbgp\Response\MessageInterface;
use Dbgp\Serialize\DbgpMessage;
use Dbgp\Serialize\SerializableInterface;
use LogicException;
use React\EventLoop\Factory;
use React\Stream\Stream;
use Dbgp\Input\AbstractInput;

/**
 * Class Debugger
 * @package Dbgp
 */
class Debugger
{
    const NAME      = 'Jphpd';
    const VERSION   = '0.1';

    /**
     * @var Stream
     */
    protected $conn;

    /**
     * @var \React\EventLoop\LoopInterface
     */
    protected $loop;

    /**
     * @var int
     */
    protected $transaction = 0;

    /**
     * @param $port
     * @param string $host
     */
    public function __construct($port, $host = '127.0.0.1')
    {
        Log::writeln('Run Jphp Debugger (example)');

        $this->loop = Factory::create();

        $socket     = stream_socket_client("tcp://${host}:${port}");
        $this->conn = new Stream($socket, $this->loop);

        $this->conn->on('data', function ($data) {
            $this->input($data);
        });
    }

    /**
     * @param $filename
     */
    public function run($filename, $key)
    {
        $init = new InitMessage($filename, $key);
        $this->write($init);

        $this->loop->run();
    }

    /**
     * @param $message
     */
    public function write($message)
    {
        if ($message instanceof MessageInterface) {
            $node = $message->getData();
        } elseif ($message instanceof SerializableInterface) {
            $node = $message;
        } else {
            throw new LogicException(
                'Message must be is instance of MessageInterface|SerializableInterface'
            );
        }

        $dbgp = (new DbgpMessage($node))
            ->serialize();

        Log::writeln('Jphpd [' . $dbgp . ']');
        flush();

        $this->conn->write($dbgp);
    }

    /**
     * @param $message
     */
    protected function input($message)
    {
        Log::writeln('IDE [' . $message . ']');

        $command = new InputCommand($message);

        $input = $this->findCommand($command);

        $answer = $input->getResponse();
        if ($answer) { $this->write($answer); }
    }


    /**
     * @param InputCommand $command
     */
    protected function findCommand(InputCommand $command)
    {
        $name = $command->getName();
        $availableCommands = [
            FeatureSetInput::class,
            StatusInput::class,
            StepIntoInput::class,
            StackGetInput::class,
            ContextNamesInput::class,
        ];

        foreach ($availableCommands as $cmd) {
            if ($cmd::getCommandName() === $name) {
                return new $cmd($command);
            }
        }

        throw new LogicException('Unknown request "' . $name . '"');
    }
}
