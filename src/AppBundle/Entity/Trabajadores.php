<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trabajadores
 *
 * @ORM\Table(name="trabajadores", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKTrabajador183740", columns={"Oficinaid"}), @ORM\Index(name="FKTrabajador622627", columns={"Tiposid"})})
 * @ORM\Entity
 */
class Trabajadores
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="DNI", type="string", length=255, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="Ciudad", type="string", length=255, nullable=true)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="Pais", type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="Web", type="string", length=255, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="Correo", type="string", length=255, nullable=true)
     */
    private $correo;

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
     * @var \AppBundle\Entity\Tipos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tiposid", referencedColumnName="id")
     * })
     */
    private $tiposid;

    /**
     * @var \AppBundle\Entity\Oficina
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Oficina")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Oficinaid", referencedColumnName="id")
     * })
     */
    private $oficinaid;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Trabajadores
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
     * Set dni
     *
     * @param string $dni
     * @return Trabajadores
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Trabajadores
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
     * Set ciudad
     *
     * @param string $ciudad
     * @return Trabajadores
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Trabajadores
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
     * Set telefono
     *
     * @param string $telefono
     * @return Trabajadores
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Trabajadores
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Trabajadores
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Trabajadores
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Trabajadores
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
     * @return Trabajadores
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
     * Set tiposid
     *
     * @param \AppBundle\Entity\Tipos $tiposid
     * @return Trabajadores
     */
    public function setTiposid(\AppBundle\Entity\Tipos $tiposid = null)
    {
        $this->tiposid = $tiposid;

        return $this;
    }

    /**
     * Get tiposid
     *
     * @return \AppBundle\Entity\Tipos 
     */
    public function getTiposid()
    {
        return $this->tiposid;
    }

    /**
     * Set oficinaid
     *
     * @param \AppBundle\Entity\Oficina $oficinaid
     * @return Trabajadores
     */
    public function setOficinaid(\AppBundle\Entity\Oficina $oficinaid = null)
    {
        $this->oficinaid = $oficinaid;

        return $this;
    }

    /**
     * Get oficinaid
     *
     * @return \AppBundle\Entity\Oficina 
     */
    public function getOficinaid()
    {
        return $this->oficinaid;
    }
}
