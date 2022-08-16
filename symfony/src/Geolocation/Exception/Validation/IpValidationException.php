<?php

namespace App\Geolocation\Exception\Validation;

use Exception;

class IpValidationException extends Exception
{
    protected $message = 'Ошибка распознавания ip адреса!';
}