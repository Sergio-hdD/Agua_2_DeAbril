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
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $nombreDeComprobante;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $numeroDeComprobante;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $importe;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroDeCuota;
   
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $causaDeRechazo;

    /* COMPOS COMUNES A TODAS LAS ENTITYS */
    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_creator")
     */
    private $userCreator;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_updater",nullable=true)
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
        $this->estado = 'A revisar';
        $this->causaDeRechazo = "";
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getNombreDeComprobante(): ?string
    {
        return $this->nombreDeComprobante;
    }

    public function setNombreDeComprobante(string $nombreDeComprobante): self
    {
        $this->nombreDeComprobante = $nombreDeComprobante;

        return $this;
    }

    public function getNumeroDeComprobante(): ?string
    {
        return $this->numeroDeComprobante;
    }

    public function setNumeroDeComprobante(?string $numeroDeComprobante): self
    {
        $this->numeroDeComprobante = $numeroDeComprobante;

        return $this;
    }

    public function getImporte(): ?float
    {
        return $this->importe;
    }

    public function setImporte(?float $importe): self
    {
        $this->importe = $importe;

        return $this;
    }

    public function getNumeroDeCuota(): ?int
    {
        return $this->numeroDeCuota;
    }

    public function setNumeroDeCuota(?int $numeroDeCuota): self
    {
        $this->numeroDeCuota = $numeroDeCuota;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
    
    public function getCausaDeRechazo(): ?string
    {
        return $this->causaDeRechazo;
    }

    public function setCausaDeRechazo(string $causaDeRechazo): self
    {
        $this->causaDeRechazo = $causaDeRechazo;

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
