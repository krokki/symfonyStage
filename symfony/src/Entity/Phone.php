<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
class Phone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * @Groups ({"all_phone_property"})
     */
    private int $id;

    #[ORM\Column(length: 255)]
    /**
     * @Groups ({"all_phone_property"})
     */
    private string $model;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    /**
     * @Groups ({"all_phone_property"})
     */
    private Manufacturer $manufacturer;

    #[ORM\Column(length: 255, nullable: true)]
    /**
     * @Groups ({"all_phone_property"})
     */
    private int $ram;

    #[ORM\Column(length: 255)]
    private ?string $Country = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getRam(): int
    {
        return $this->ram;
    }

    public function setRam(int $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }
}
