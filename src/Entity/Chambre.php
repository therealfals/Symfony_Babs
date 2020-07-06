<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numBatiment;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $occuped;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $occuped2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNumBatiment(): ?int
    {
        return $this->numBatiment;
    }

    public function setNumBatiment(?int $numBatiment): self
    {
        $this->numBatiment = $numBatiment;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOccuped(): ?string
    {
        return $this->occuped;
    }

    public function setOccuped(?string $occuped): self
    {
        $this->occuped = $occuped;

        return $this;
    }

    public function getOccuped2(): ?string
    {
        return $this->occuped2;
    }

    public function setOccuped2(?string $occuped2): self
    {
        $this->occuped2 = $occuped2;

        return $this;
    }
}
