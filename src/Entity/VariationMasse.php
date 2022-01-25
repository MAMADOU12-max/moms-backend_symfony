<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VariationMasseRepository;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=VariationMasseRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "get","post"
 *      },
 *      itemOperations ={
 *          "delete","get","put"
 *      }
 *      
 * )
 */
class VariationMasse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"machines:read"})
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Machines::class, inversedBy="VariationMasse",cascade={"persist"})
     */
    private $machines;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"machines:read"})
     */
    private $date;

    public function __construct()
    {
        return $this->date = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getMachines(): ?Machines
    {
        return $this->machines;
    }

    public function setMachines(?Machines $machines): self
    {
        $this->machines = $machines;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
