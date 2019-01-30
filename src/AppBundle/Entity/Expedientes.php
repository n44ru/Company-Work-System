<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expedientes
 *
 * @ORM\Table(name="expedientes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKExpediente879605", columns={"Proyectoid"})})
 * @ORM\Entity
 */
class Expedientes
{
    /**
     * @var string
     *
     * @ORM\Column(name="procedimiento", type="string", length=255, nullable=true)
     */
    private $procedimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="actuacion", type="string", length=255, nullable=true)
     */
    private $actuacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo", type="string", length=255, nullable=true)
     */
    private $tiempo;

    /**
     * @var string
     *
     * @ORM\Column(name="tareas", type="string", length=255, nullable=true)
     */
    private $tareas;

    /**
     * @var string
     *
     * @ORM\Column(name="organorelacion", type="string", length=255, nullable=true)
     */
    private $organorelacion;

    /**
     * @var string
     *
     * @ORM\Column(name="fechacomienzo", type="string", length=255, nullable=true)
     */
    private $fechacomienzo;

    /**
     * @var string
     *
     * @ORM\Column(name="fechafin", type="string", length=255, nullable=true)
     */
    private $fechafin;

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
     * @var \AppBundle\Entity\Proyecto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Proyecto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Proyectoid", referencedColumnName="id")
     * })
     */
    private $proyectoid;



    /**
     * Set procedimiento
     *
     * @param string $procedimiento
     * @return Expedientes
     */
    public function setProcedimiento($procedimiento)
    {
        $this->procedimiento = $procedimiento;

        return $this;
    }

    /**
     * Get procedimiento
     *
     * @return string 
     */
    public function getProcedimiento()
    {
        return $this->procedimiento;
    }

    /**
     * Set actuacion
     *
     * @param string $actuacion
     * @return Expedientes
     */
    public function setActuacion($actuacion)
    {
        $this->actuacion = $actuacion;

        return $this;
    }

    /**
     * Get actuacion
     *
     * @return string 
     */
    public function getActuacion()
    {
        return $this->actuacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Expedientes
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tiempo
     *
     * @param string $tiempo
     * @return Expedientes
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return string 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set tareas
     *
     * @param string $tareas
     * @return Expedientes
     */
    public function setTareas($tareas)
    {
        $this->tareas = $tareas;

        return $this;
    }

    /**
     * Get tareas
     *
     * @return string 
     */
    public function getTareas()
    {
        return $this->tareas;
    }

    /**
     * Set organorelacion
     *
     * @param string $organorelacion
     * @return Expedientes
     */
    public function setOrganorelacion($organorelacion)
    {
        $this->organorelacion = $organorelacion;

        return $this;
    }

    /**
     * Get organorelacion
     *
     * @return string 
     */
    public function getOrganorelacion()
    {
        return $this->organorelacion;
    }

    /**
     * Set fechacomienzo
     *
     * @param string $fechacomienzo
     * @return Expedientes
     */
    public function setFechacomienzo($fechacomienzo)
    {
        $this->fechacomienzo = $fechacomienzo;

        return $this;
    }

    /**
     * Get fechacomienzo
     *
     * @return string 
     */
    public function getFechacomienzo()
    {
        return $this->fechacomienzo;
    }

    /**
     * Set fechafin
     *
     * @param string $fechafin
     * @return Expedientes
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
     * @return Expedientes
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
     * @return Expedientes
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
     * Set proyectoid
     *
     * @param \AppBundle\Entity\Proyecto $proyectoid
     * @return Expedientes
     */
    public function setProyectoid(\AppBundle\Entity\Proyecto $proyectoid = null)
    {
        $this->proyectoid = $proyectoid;

        return $this;
    }

    /**
     * Get proyectoid
     *
     * @return \AppBundle\Entity\Proyecto 
     */
    public function getProyectoid()
    {
        return $this->proyectoid;
    }
}
