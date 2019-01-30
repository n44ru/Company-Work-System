<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Socios
 *
 * @ORM\Table(name="socios", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKSocios191490", columns={"Personaid"}), @ORM\Index(name="FKSocios250145", columns={"Empresaid"})})
 * @ORM\Entity
 */
class Socios
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
     * @ORM\Column(name="acciones", type="string", length=255, nullable=true)
     */
    private $acciones;

    /**
     * @var string
     *
     * @ORM\Column(name="fechaadq", type="string", length=255, nullable=true)
     */
    private $fechaadq;

    /**
     * @var string
     *
     * @ORM\Column(name="accionescompradas", type="string", length=255, nullable=true)
     */
    private $accionescompradas;

    /**
     * @var string
     *
     * @ORM\Column(name="venta", type="string", length=255, nullable=true)
     */
    private $venta;

    /**
     * @var string
     *
     * @ORM\Column(name="accionesvendidas", type="string", length=255, nullable=true)
     */
    private $accionesvendidas;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="string", length=255, nullable=true)
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
     * @var \AppBundle\Entity\Empresa
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Empresaid", referencedColumnName="id")
     * })
     */
    private $empresaid;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Personaid", referencedColumnName="id")
     * })
     */
    private $personaid;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Socios
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
     * Set acciones
     *
     * @param string $acciones
     * @return Socios
     */
    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;

        return $this;
    }

    /**
     * Get acciones
     *
     * @return string 
     */
    public function getAcciones()
    {
        return $this->acciones;
    }

    /**
     * Set fechaadq
     *
     * @param string $fechaadq
     * @return Socios
     */
    public function setFechaadq($fechaadq)
    {
        $this->fechaadq = $fechaadq;

        return $this;
    }

    /**
     * Get fechaadq
     *
     * @return string 
     */
    public function getFechaadq()
    {
        return $this->fechaadq;
    }

    /**
     * Set accionescompradas
     *
     * @param string $accionescompradas
     * @return Socios
     */
    public function setAccionescompradas($accionescompradas)
    {
        $this->accionescompradas = $accionescompradas;

        return $this;
    }

    /**
     * Get accionescompradas
     *
     * @return string 
     */
    public function getAccionescompradas()
    {
        return $this->accionescompradas;
    }

    /**
     * Set venta
     *
     * @param string $venta
     * @return Socios
     */
    public function setVenta($venta)
    {
        $this->venta = $venta;

        return $this;
    }

    /**
     * Get venta
     *
     * @return string 
     */
    public function getVenta()
    {
        return $this->venta;
    }

    /**
     * Set accionesvendidas
     *
     * @param string $accionesvendidas
     * @return Socios
     */
    public function setAccionesvendidas($accionesvendidas)
    {
        $this->accionesvendidas = $accionesvendidas;

        return $this;
    }

    /**
     * Get accionesvendidas
     *
     * @return string 
     */
    public function getAccionesvendidas()
    {
        return $this->accionesvendidas;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Socios
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
     * @return Socios
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

    /**
     * Set empresaid
     *
     * @param \AppBundle\Entity\Empresa $empresaid
     * @return Socios
     */
    public function setEmpresaid(\AppBundle\Entity\Empresa $empresaid = null)
    {
        $this->empresaid = $empresaid;

        return $this;
    }

    /**
     * Get empresaid
     *
     * @return \AppBundle\Entity\Empresa 
     */
    public function getEmpresaid()
    {
        return $this->empresaid;
    }

    /**
     * Set personaid
     *
     * @param \AppBundle\Entity\Persona $personaid
     * @return Socios
     */
    public function setPersonaid(\AppBundle\Entity\Persona $personaid = null)
    {
        $this->personaid = $personaid;

        return $this;
    }

    /**
     * Get personaid
     *
     * @return \AppBundle\Entity\Persona 
     */
    public function getPersonaid()
    {
        return $this->personaid;
    }
}
