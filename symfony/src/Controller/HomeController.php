<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller;
use \App\Entity\Phone;
use \App\Entity\Manufacturer;
use App\Service\Phone\PhoneService;

class HomeController extends AbstractController
{

    public function index(): Response
    {
        $params = ['name' => 'Ivan', 'age' => 21];
        return  $this->render(view: 'home/home.html.twig', parameters: $params);
    }

    public function createPhoneManufacturer (EntityManagerInterface $entityManager): Response
    {
        $manufacturer = new Manufacturer();
        $manufacturer->setCountry('Russia');
        $manufacturer->setName('IBM-RU');

        $phone = new Phone();
        $phone->setModel('SF124G');
        $phone->setRam(256);
        $phone->setManufacturer($manufacturer);

        $entityManager->persist($manufacturer);
        $entityManager->persist($phone);
        $entityManager->flush();

        dd($phone);
        return new Response('Inserted new model phone with id = '.$phone->getId());
    }


    public function getOnePhoneInfo (PhoneService $phoneService): Response
    {
        $idManufacturer = 3;
        $phoneSpecs = ['model' => 'Xiaomi', 'ram' => 1024];
        $result = $phoneService->addPhone($idManufacturer, $phoneSpecs);


        return $this->render(view: 'home/phoneData.html.twig', parameters: $phoneData);
    }
}
