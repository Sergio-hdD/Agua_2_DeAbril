<?php

namespace App\Entity;

use App\Repository\PagoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PagoRepository::class)
 */
class Pago
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comprobante;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aprobado;

    /* COMPOS COMUNES A TODAS LAS ENTITYS */
    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_creator")
     */
    private $userCreator;

        /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_creator",nullable=true)
     */
    private $userUpdater;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $udatedAt;
    /* FIN CAMPOS COMUNES */

    public function __construct()
    {
        $this->fecha = new \DateTime('now');
        $this->aprobado = false;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getComprobante(): ?string
    {
        return $this->comprobante;
    }

    public function setComprobante(string $comprobante): self
    {
        $this->comprobante = $comprobante;

        return $this;
    }

    public function getAprobado(): ?bool
    {
        return $this->aprobado;
    }

    public function setAprobado(?bool $aprobado): self
    {
        $this->aprobado = $aprobado;

        return $this;
    }

    /* COMPOS COMUNES A TODAS LAS ENTITYS */
    public function getUserCreator(): ?User
    {
        return $this->userCreator;
    }

    public function setUserCreator(?User $userCreator): self
    {
        $this->userCreator = $userCreator;

        return $this;
    }

    public function getUserUpdater(): ?User
    {
        return $this->userUpdater;
    }

    public function setUserUpdater(?User $userUpdater): self
    {
        $this->userUpdater = $userUpdater;

        return $this;
    } 

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUdatedAt(): ?\DateTimeInterface
    {
        return $this->udatedAt;
    }

    public function setUdatedAt(\DateTimeInterface $udatedAt): self
    {
        $this->udatedAt = $udatedAt;

        return $this;
    }
    /* FIN CAMPOS COMUNES */
}
