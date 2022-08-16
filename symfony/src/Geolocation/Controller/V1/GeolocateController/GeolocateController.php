<?php

namespace App\Geolocation\Controller\V1\GeolocateController;

use App\Geolocation\Exception\GeolocationException;
use App\Geolocation\Exception\GettingGeoException;
use App\Geolocation\Exception\Validation\IpValidationException;
use App\Geolocation\Service\GeolocateService\Geolocator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class GeolocateController extends AbstractController
{
    public function getIpGeolocate(Request $request, Geolocator $geolocator, HttpClientInterface $httpClient): JsonResponse
    {
        try {
            $ip = $httpClient->request('GET', 'https://ipecho.net/plain')->getContent();
            //$ip = '214.412.412.122.512';
            $geoData = $geolocator->getGeolocate($ip);
        }
        catch (GettingGeoException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (IpValidationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        dd($geoData);
    }
}
