<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tareas
 *
 * @ORM\Table(name="tareas", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKTareas337427", columns={"Trabajadoresid"}), @ORM\Index(name="FKTareas298622", columns={"Operacionesid"})})
 * @ORM\Entity
 */
class Tareas
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="fechainicio", type="string", length=255, nullable=true)
     */
    private $fechainicio;

    /**
     * @var string
     *
     * @ORM\Column(name="fechafin", type="string", length=255, nullable=true)
     */
    private $fechafin;

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
     * @var \AppBundle\Entity\Trabajadores
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trabajadores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Trabajadoresid", referencedColumnName="id")
     * })
     */
    private $trabajadoresid;

    /**
     * @var \AppBundle\Entity\Operaciones
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Operaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Operacionesid", referencedColumnName="id")
     * })
     */
    private $operacionesid;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tareas
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tareas
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
     * Set fechainicio
     *
     * @param string $fechainicio
     * @return Tareas
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return string 
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin
     *
     * @param string $fechafin
     * @return Tareas
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return string 
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Tareas
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
     * @return Tareas
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
     * Set trabajadoresid
     *
     * @param \AppBundle\Entity\Trabajadores $trabajadoresid
     * @return Tareas
     */
    public function setTrabajadoresid(\AppBundle\Entity\Trabajadores $trabajadoresid = null)
    {
        $this->trabajadoresid = $trabajadoresid;

        return $this;
    }

    /**
     * Get trabajadoresid
     *
     * @return \AppBundle\Entity\Trabajadores 
     */
    public function getTrabajadoresid()
    {
        return $this->trabajadoresid;
    }

    /**
     * Set operacionesid
     *
     * @param \AppBundle\Entity\Operaciones $operacionesid
     * @return Tareas
     */
    public function setOperacionesid(\AppBundle\Entity\Operaciones $operacionesid = null)
    {
        $this->operacionesid = $operacionesid;

        return $this;
    }

    /**
     * Get operacionesid
     *
     * @return \AppBundle\Entity\Operaciones 
     */
    public function getOperacionesid()
    {
        return $this->operacionesid;
    }
}
