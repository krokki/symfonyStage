<?php

namespace App\Service\Phone;

use App\Entity\Manufacturer;
use App\Entity\Phone;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;

class PhoneService
{
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /** @noinspection PhpUndefinedVariableInspection */
    public function addPhone(Manufacturer $manufacturer, array $phoneSpecs): Phone
    {
        $phone = new Phone();
        $phone->setModel($phoneSpecs['model']);
        $phone->setRam($phoneSpecs['ram']);
        $phone->setManufacturer($manufacturer);
        $phone->setCountry($manufacturer->getCountry());
        $this->em->persist($phone);
        $this->em->flush();
        return $phone;
    }

    public function dropAllPhones(): void
    {
        $repository = $this->em->getRepository(Phone::class);
        $repository->removeAllPhones();
    }
}
