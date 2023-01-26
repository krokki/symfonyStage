<?php

namespace App\Geolocation\Exception;

class GetGeolocationException extends GeolocationException
{
    protected $message = 'Не удалось получить данные геолокации!';
}
