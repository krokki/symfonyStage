<?php

namespace App\Controller\V1;

use App\Entity\Manufacturer;
use App\Entity\Phone;
use App\Service\Phone\PhoneService;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function App\Controller\dd;

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


    public function addPhone()
    {

    }


    public function  addOnePhone(int $id, Request $request, EntityManagerInterface $em, PhoneService $phoneService): void
    {

        $phoneSpecs = $request->toArray();

        $manufacturer = $em->getRepository(Manufacturer::class)->find($id);

        if (!$manufacturer) {
            throw new ErrorException('Производитель с заданным id не существует!');
        }

        $phone = $phoneService->addPhone($manufacturer, $phoneSpecs);
        dd($phone);

    }


//    /**
//     * @throws ErrorException
//     */
//    public function getOnePhoneInfo (EntityManagerInterface $em, PhoneService $phoneService): Response
//    {
//        $idManufacturer = 14;
//        $phoneSpecs = ['model' => 'OnePlus', 'ram' => 256];
//
//        $manufacturer =  $this->$em->getRepository(Manufacturer::class)->find($idManufacturer);
//        if (!$manufacturer) {
//            throw new ErrorException('Производитель с заданным id не существует!');
//        }
//
//        //return $this->em->getRepository(Manufacturer::class)->find($id);
//        $phone = $phoneService->addPhone($manufacturer, $phoneSpecs);
//        dd($phone);
//        return $this->render(view: 'home/phoneData.html.twig', parameters: $result);
//    }
}
