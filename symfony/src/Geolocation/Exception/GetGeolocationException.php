<?php

namespace App\Geolocation\Exception;

use Throwable;

class GetGeolocationException extends GeolocationException
{
    protected $message = 'Не удалось получить данные геолокации!';

    public function __construct(string $ip, Throwable $previous)
    {
        parent::__construct($this->message, 0, $previous);
        $this->ip  = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
