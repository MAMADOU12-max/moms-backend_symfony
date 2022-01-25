<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MachinesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *    denormalizationContext={"groups"={"machines:write"}} ,   
 *    normalizationContext={"groups"={"machines:read"}} ,   
 * )
 * @ORM\Entity(repositoryClass=MachinesRepository::class)
 */
class Machines
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"machines:read","ecoles:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("machines:write", "machines:read", "ecoles:read")
     */
    private $keymachine;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("machines:write","machines:read", "ecoles:read")
     */
    private $localisation;

    /**
     * @ORM\OneToMany(targetEntity=VariationMasse::class, mappedBy="machines",cascade={"persist"})
     * @Groups({"machines:read"})
     */
    private $VariationMasse;

    /**
     * @ORM\ManyToOne(targetEntity=Ecoles::class, inversedBy="machines")
      * @Groups("machines:write")
     */
    private $ecoles;

    public function __construct()
    {
        $this->VariationMasse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeymachine(): ?string
    {
        return $this->keymachine;
    }

    public function setKeymachine(string $keymachine): self
    {
        $this->keymachine = $keymachine;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection|VariationMasse[]
     */
    public function getVariationMasse(): Collection
    {
        return $this->VariationMasse;
    }

    public function addVariationMasse(VariationMasse $variationMasse): self
    {
        if (!$this->VariationMasse->contains($variationMasse)) {
            $this->VariationMasse[] = $variationMasse;
            $variationMasse->setMachines($this);
        }

        return $this;
    }

    public function removeVariationMasse(VariationMasse $variationMasse): self
    {
        if ($this->VariationMasse->removeElement($variationMasse)) {
            // set the owning side to null (unless already changed)
            if ($variationMasse->getMachines() === $this) {
                $variationMasse->setMachines(null);
            }
        }

        return $this;
    }

    public function getEcoles(): ?Ecoles
    {
        return $this->ecoles;
    }

    public function setEcoles(?Ecoles $ecoles): self
    {
        $this->ecoles = $ecoles;

        return $this;
    }
}
