<?php

namespace App\Geolocation\Exception;

use Exception;

class GeolocationException extends Exception
{
    public string $ip;
}