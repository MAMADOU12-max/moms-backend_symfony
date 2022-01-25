<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EcolesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=EcolesRepository::class)
 * @ApiResource(
 *    denormalizationContext={"groups"={"ecoles:write"}} ,   
 *    normalizationContext={"groups"={"ecoles:read"}} , 
 * )
 */
class Ecoles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ecoles:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ecoles:read", "ecoles:write"})
     */
    private $name;

    /**
     * @Groups({"ecoles:read"})
     * @ORM\OneToMany(targetEntity=Machines::class, mappedBy="ecoles")
     */
    private $machines;

    public function __construct()
    {
        $this->machines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Machines[]
     */
    public function getMachines(): Collection
    {
        return $this->machines;
    }

    public function addMachine(Machines $machine): self
    {
        if (!$this->machines->contains($machine)) {
            $this->machines[] = $machine;
            $machine->setEcoles($this);
        }

        return $this;
    }

    public function removeMachine(Machines $machine): self
    {
        if ($this->machines->removeElement($machine)) {
            // set the owning side to null (unless already changed)
            if ($machine->getEcoles() === $this) {
                $machine->setEcoles(null);
            }
        }

        return $this;
    }
}
