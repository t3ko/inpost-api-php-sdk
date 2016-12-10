<?php

namespace T3ko\Inpost\Objects;

class PackageFactory
{
    /**
     * @param string $senderEmail          Sender's email address
     * @param string $packageType          Inpost package type ('A', 'B' or 'C')
     * @param string $addresseeEmail       Addressee's email address
     * @param string $addresseePhoneNumber Addressee's phone number
     * @param string $addresseeMachineName Target package machine name
     *
     * @return PackageBuilder
     */
    public function getPackageBuilder($senderEmail, $packageType, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName)
    {
        return new PackageBuilder($senderEmail, $packageType, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName);
    }

    /**
     * @param PackageBuilder $builder
     *
     * @return Package
     */
    public function createPackage(PackageBuilder $builder)
    {
        return new Package($builder);
    }
}
