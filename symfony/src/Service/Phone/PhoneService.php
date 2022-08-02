<?php

namespace App\Service\Phone;

use App\Entity\Manufacturer;
use App\Entity\Phone;
use Doctrine\ORM\EntityManagerInterface;

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

    public function addPhone(int $idManufacturer, array $phoneSpecs): void
    {
        $repository = $this->em->getRepository(Manufacturer::class);
        $manufacturerExist = $repository->find($idManufacturer);

        dd($manufacturerExist);
    }
}