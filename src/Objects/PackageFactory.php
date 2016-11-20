<?php

namespace T3ko\Inpost\Objects;

class PackageFactory
{
    /**
     * @return PackageBuilder
     * @param $addresseeEmail
     * @param $addresseePhoneNumber
     * @param $senderEmail
     */
    public function getPackageBuilder($senderEmail, $packageType, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName)
    {
        return new PackageBuilder($senderEmail, $packageType, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName);
    }

    /**
     * @param PackageBuilder $builder
     * @return Package
     */
    public function createPackage(PackageBuilder $builder)
    {
        return new Package($builder);
    }

}