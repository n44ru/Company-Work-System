<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Empresa
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cif", type="string", length=255, nullable=true)
     */
    private $cif;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="cuidad", type="string", length=255, nullable=true)
     */
    private $cuidad;

    /**
     * @var string
     *
     * @ORM\Column(name="banco", type="string", length=255, nullable=true)
     */
    private $banco;

    /**
     * @var string
     *
     * @ORM\Column(name="swift", type="string", length=255, nullable=true)
     */
    private $swift;

    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", length=255, nullable=true)
     */
    private $iban;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta", type="string", length=255, nullable=true)
     */
    private $cuenta;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="string", length=500, nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="fichero", type="string", length=255, nullable=true)
     */
    private $fichero;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Empresa
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cif
     *
     * @param string $cif
     * @return Empresa
     */
    public function setCif($cif)
    {
        $this->cif = $cif;

        return $this;
    }

    /**
     * Get cif
     *
     * @return string 
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Empresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Empresa
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set cuidad
     *
     * @param string $cuidad
     * @return Empresa
     */
    public function setCuidad($cuidad)
    {
        $this->cuidad = $cuidad;

        return $this;
    }

    /**
     * Get cuidad
     *
     * @return string 
     */
    public function getCuidad()
    {
        return $this->cuidad;
    }

    /**
     * Set banco
     *
     * @param string $banco
     * @return Empresa
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get banco
     *
     * @return string 
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Set swift
     *
     * @param string $swift
     * @return Empresa
     */
    public function setSwift($swift)
    {
        $this->swift = $swift;

        return $this;
    }

    /**
     * Get swift
     *
     * @return string 
     */
    public function getSwift()
    {
        return $this->swift;
    }

    /**
     * Set iban
     *
     * @param string $iban
     * @return Empresa
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string 
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set cuenta
     *
     * @param string $cuenta
     * @return Empresa
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    /**
     * Get cuenta
     *
     * @return string 
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Empresa
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * Get notas
     *
     * @return string 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set fichero
     *
     * @param string $fichero
     * @return Empresa
     */
    public function setFichero($fichero)
    {
        $this->fichero = $fichero;

        return $this;
    }

    /**
     * Get fichero
     *
     * @return string 
     */
    public function getFichero()
    {
        return $this->fichero;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
