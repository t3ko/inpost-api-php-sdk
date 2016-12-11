<?php

namespace T3ko\Inpost\Objects\Shipment;

/**
 * Class SelfSentPackage.
 *
 * Represents a package sent to a machine or a POP, sent by the sender himself using a machine.
 */
class SelfSentPackage extends Package
{
    private $senderBoxMachineName;

    /**
     * SelfSentPackage constructor.
     *
     * @param SelfSentPackageBuilder $builder
     */
    public function __construct(SelfSentPackageBuilder $builder)
    {
        parent::__construct($builder);
        $this->senderBoxMachineName = $builder->getSenderMachineName();
    }

    /**
     * @return string
     */
    public function getSenderBoxMachineName()
    {
        return $this->senderBoxMachineName;
    }
}
