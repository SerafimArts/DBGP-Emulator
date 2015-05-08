<?php
namespace Dbgp\Input;

use Dbgp\InputCommand;
use Dbgp\Response\FeatureSetMessage;

/**
 * Class FeatureSetInput
 * @package Dbgp\Input
 */
class FeatureSetInput extends AbstractInput
{
    const COMMAND_NAME = 'feature_set';

    /**
     * @TODO Not working yet
     * @return FeatureSetMessage|\Dbgp\Response\MessageInterface|\Dbgp\Serialize\SerializableInterface|\Dbgp\Serialize\Xml\RootNode|null
     */
    public function getResponse()
    {
        $cmd = $this->getCommand();

        return new FeatureSetMessage(
            $cmd->getOption('i'),
            $cmd->getOption('n')
        );
    }
}
