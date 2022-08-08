<?php

namespace App\Exceptions\ResponseException;

use Doctrine\DBAL\Exception;

class ResponseIpifyException extends \Exception
{
    protected $message = 'Failed to get ip address, please try again later.';
}