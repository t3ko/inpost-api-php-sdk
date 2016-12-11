<?php

namespace T3ko\Inpost\Objects\Shipment;

class SelfSentPackageBuilder extends PackageBuilder
{
    private $senderMachineName;

    /**
     * PackageBuilder constructor.
     *
     * @param string $senderEmail          Sender's email address
     * @param string $size                 Inpost package size identifier ('A', 'B' or 'C')
     * @param string $addresseeEmail       Addressee's email address
     * @param string $addresseePhoneNumber Addressee's phone number
     * @param string $addresseeMachineName Target package machine name
     * @param string $senderMachineName    Name of the package machine that will be used to send the package
     *
     * @see Size
     */
    public function __construct($senderEmail, $size, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName, $senderMachineName)
    {
        parent::__construct($senderEmail, $size, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName);
        $this->senderMachineName = $senderMachineName;
    }

    public function build()
    {
        return new SelfSentPackage($this);
    }

    /**
     * @return string
     */
    public function getSenderMachineName()
    {
        return $this->senderMachineName;
    }

    /**
     * @param string $senderMachineName
     *
     * @return SelfSentPackageBuilder
     */
    public function setSenderMachineName($senderMachineName)
    {
        $this->senderMachineName = $senderMachineName;

        return $this;
    }
}
