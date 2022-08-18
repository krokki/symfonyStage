<?php

namespace App\Geolocation\Exception\Validation;

use Exception;
use Throwable;

class IpValidationException extends Exception
{
    protected $message = 'Ошибка распознавания ip адреса!';
    public string $ip;

    public function __construct(string $ip)
    {
        parent::__construct($this->message, 0, null);
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
