<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto
 *
 * @ORM\Table(name="proyecto", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKProyecto795944", columns={"Personaid"}), @ORM\Index(name="FKProyecto596954", columns={"Oficinaid"}), @ORM\Index(name="FKProyecto493791", columns={"Servicioid"})})
 * @ORM\Entity
 */
class Proyecto
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
     * @ORM\Column(name="fecha_inicio", type="string", length=255, nullable=true)
     */
    private $fechaInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_fin", type="string", length=255, nullable=true)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos", type="string", length=255, nullable=true)
     */
    private $objetivos;

    /**
     * @var string
     *
     * @ORM\Column(name="Importe", type="string", length=255, nullable=true)
     */
    private $importe;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuesto", type="string", length=255, nullable=true)
     */
    private $presupuesto;

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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var \AppBundle\Entity\Oficina
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Oficina")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Oficinaid", referencedColumnName="id")
     * })
     */
    private $oficinaid;

    /**
     * @var \AppBundle\Entity\Servicio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Servicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Servicioid", referencedColumnName="id")
     * })
     */
    private $servicioid;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Proyecto
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
     * Set fechaInicio
     *
     * @param string $fechaInicio
     * @return Proyecto
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return string 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param string $fechaFin
     * @return Proyecto
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return string 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set objetivos
     *
     * @param string $objetivos
     * @return Proyecto
     */
    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;

        return $this;
    }

    /**
     * Get objetivos
     *
     * @return string 
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    /**
     * Set importe
     *
     * @param string $importe
     * @return Proyecto
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return string 
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set presupuesto
     *
     * @param string $presupuesto
     * @return Proyecto
     */
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return string 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Proyecto
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
     * @return Proyecto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Proyecto
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set personaid
     *
     * @param \AppBundle\Entity\Persona $personaid
     * @return Proyecto
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

    /**
     * Set oficinaid
     *
     * @param \AppBundle\Entity\Oficina $oficinaid
     * @return Proyecto
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

    /**
     * Set servicioid
     *
     * @param \AppBundle\Entity\Servicio $servicioid
     * @return Proyecto
     */
    public function setServicioid(\AppBundle\Entity\Servicio $servicioid = null)
    {
        $this->servicioid = $servicioid;

        return $this;
    }

    /**
     * Get servicioid
     *
     * @return \AppBundle\Entity\Servicio 
     */
    public function getServicioid()
    {
        return $this->servicioid;
    }
}
