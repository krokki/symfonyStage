<?php

namespace App\Exceptions\IpifyException;

use Throwable;

class NotFoundIpException extends IpifyException
{
    protected $message = 'Не удалось найти ip адрес =(';
}
