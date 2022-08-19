<?php

namespace App\Geolocation\Exception\Validation;

use App\Geolocation\Exception\GeolocationException;

class IpValidationException extends GeolocationException
{
    protected $message = 'Ошибка распознавания ip адреса!';
}
