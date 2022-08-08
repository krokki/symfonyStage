<?php

namespace App\Service\HttpClient;

use _PHPStan_9a6ded56a\Nette\Neon\Exception;
use App\Exceptions\IpifyException\NotFoundIpException;
use App\Exceptions\IpifyException\GettingIpException;
use App\Service\HttpClient\IpifyHttpClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use App\Exceptions\IpifyException\IpifyException;


class HttpClientService
{
    public IpifyHttpClient $ipifyClient;

    /**
     * @param IpifyHttpClient $ipifyClient
     */
    public function __construct(IpifyHttpClient $ipifyClient)
    {
        $this->ipifyClient = $ipifyClient;
    }

    /**
     * @throws GettingIpException
     */
    public function getIp(): string
    {
        try {
            $ipResponse = $this->ipifyClient->request('GET', '', ['query' => ['format' => 'json']]);
            $ipData = $ipResponse->toArray();
            $ip = $ipData["ip"];
        }
        catch (ExceptionInterface $e) {
            throw new GettingIpException(previous: $e);
        }
        return $ip;
    }
}
