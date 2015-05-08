<?php
namespace Dbgp\Response;

use Dbgp\Serialize\Xml\RootNode;

/**
 * Class FeatureSetMessage
 * @package Dbgp\Message
 */
class FeatureSetMessage extends ResponseMessage
{
    /**
     * @var mixed
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $feature = '';

    /**
     * @var int
     */
    protected $status = 1;

    /**
     * @param $transactionId
     * @param $feature
     * @param int $status
     */
    public function __construct($transactionId, $feature, $status = 1)
    {
        parent::__construct($transactionId, 'feature_set');
        $this->feature = $feature;
        $this->status = $status;
    }

    /**
     * @return \Dbgp\Serialize\SerializableInterface|RootNode
     */
    public function getData()
    {
        $root = parent::getData();
        $root->addAttribute('feature', $this->feature);
        $root->addAttribute('success', $this->status);
        return $root;
    }
}
