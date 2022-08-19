<?php

namespace App\Geolocation\Exception;

use Exception;

class GeolocationException extends Exception
{
    private string $ip;

    public function __construct(string $ip, ?Exception $previous = null, int $code = 0)
    {
        parent::__construct(self::getMessage(), $code, $previous);

        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }
}
