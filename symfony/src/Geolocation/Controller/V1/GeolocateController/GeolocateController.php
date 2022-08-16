<?php

namespace App\Geolocation\Controller\V1\GeolocateController;

use App\Geolocation\Service\GeolocateService\Geolocator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeolocateController extends AbstractController
{
    public function getIpGeolocate(Request $request, Geolocator $geolocator, HttpClientInterface $httpClient): void
    {
        $ip = $httpClient->request('GET', 'https://ipecho.net/plain')->getContent();
        $result = $geolocator->getGeolocate($ip);

        dd($result);
    }
}
