<?php

namespace App\Entity;

use App\Repository\GeolocationCacheRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\DependencyInjection;

/**
 * @Entity(repositoryClass="App\Repository\GeolocationCacheRepository")
 */
class GeolocationCache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private string $ip;

    /**
     * @ORM\Column(type="json")
     */
    private array $geolocation;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return GeolocationCache
     */
    public function setIp(string $ip): GeolocationCache
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return array
     */
    public function getGeolocation(): array
    {
        return $this->geolocation;
    }

    /**
     * @param array $geolocation
     * @return GeolocationCache
     */
    public function setGeolocation(array $geolocation): GeolocationCache
    {
        $this->geolocation = $geolocation;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

