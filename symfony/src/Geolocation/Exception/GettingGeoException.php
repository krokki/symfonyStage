<?php

namespace App\Geolocation\Exception;

use Throwable;


class GettingGeoException extends GeolocationException
{
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
