<?php

namespace App\Controller\V1;

use App\Entity\Manufacturer;
use App\Entity\Phone;
use App\Service\Phone\PhoneService;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
use Normalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class HomeController extends AbstractController
{
    private NormalizerInterface $normalizerInterface;

    /**
     * @param NormalizerInterface $ni
     */
    public function __construct(NormalizerInterface $ni)
    {
        $this->normalizerInterface = $ni;
    }

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


    public function practiceAlg(): ?Response
    {
            $string = "man in Black   ";
            $prepare = "";
            $result = "";
            $offset = strlen($string) - 1;

            for($i = $offset; $i--;)
            {
                if($string[$i] !== ' ') break;
            }

            for($i = $offset; $i--;)
            {
                if($string[$i] === ' ') break;
                $prepare .= $string[$i];
            }
            for($j = strlen($prepare); $j--;)
            {
             $result.= $prepare[$j];
            }
            echo $result;

            return new Response("");
    }


    public function  addOnePhone(Manufacturer $manufacturer, Request $request, EntityManagerInterface $em, PhoneService $phoneService): JsonResponse
    {
        //        Так тоже можно
        //        $normalizers = [new ObjectNormalizer()];
        //        $serializer = new Serializer($normalizers, []);
        //        $arrPhone = $serializer->normalize($phone);

        $phoneSpecs = $request->toArray();
        $phone = $phoneService->addPhone($manufacturer, $phoneSpecs);
        /** @noinspection PhpUnhandledExceptionInspection */
        $arrPhone = $this->normalizerInterface->normalize($phone); //object to array
        return $this->json($arrPhone);
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
        //home:
        //  path: /home
        //  controller: App\Controller\HomeController::index
        //
        //insert:
        //  path: /insert
        //  controller: App\Controller\HomeController::createPhoneManufacturer
        //
        //addPhone:
        //  path: /V1/manufacturers/{id}/phones
        //  controller: App\Controller\V1\HomeController::addOnePhone
//    }

}
