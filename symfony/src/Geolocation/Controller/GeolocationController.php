<?php

namespace App\Geolocation\Controller;

use App\Geolocation\Exception\GetGeolocationException;
use App\Geolocation\Exception\Validation\IpValidationException;
use App\Geolocation\Service\Geolocator\GeolocationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GeolocationController extends AbstractController
{
    public function getIpGeolocate(Request $request, GeolocationInterface $geolocateService): JsonResponse
    {
        $ip = $request->getClientIp();

        try {
            $geo = $geolocateService->getGeolocation($ip);

            return $this->json($geo);
        } catch (GetGeolocationException $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'fields' => ['ip' => $e->getIp()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (IpValidationException $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'fields' => ['ip' => $e->getIp()]], Response::HTTP_BAD_REQUEST);
        }
    }
}
