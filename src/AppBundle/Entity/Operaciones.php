<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operaciones
 *
 * @ORM\Table(name="operaciones", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKOperacione845807", columns={"Proyectoid"})})
 * @ORM\Entity
 */
class Operaciones
{
    /**
     * @var string
     *
     * @ORM\Column(name="Fecha", type="string", length=255, nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Despacho", type="string", length=255, nullable=true)
     */
    private $despacho;

    /**
     * @var string
     *
     * @ORM\Column(name="nombresolicita", type="string", length=255, nullable=true)
     */
    private $nombresolicita;

    /**
     * @var string
     *
     * @ORM\Column(name="cargosolicita", type="string", length=255, nullable=true)
     */
    private $cargosolicita;

    /**
     * @var string
     *
     * @ORM\Column(name="presenciapais", type="string", length=255, nullable=true)
     */
    private $presenciapais;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="montoestimado", type="string", length=255, nullable=true)
     */
    private $montoestimado;

    /**
     * @var string
     *
     * @ORM\Column(name="tecnologias", type="string", length=255, nullable=true)
     */
    private $tecnologias;

    /**
     * @var string
     *
     * @ORM\Column(name="experiencias", type="string", length=255, nullable=true)
     */
    private $experiencias;

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
     * @ORM\Column(name="ficheros2", type="string", length=255, nullable=true)
     */
    private $ficheros2;

    /**
     * @var string
     *
     * @ORM\Column(name="ficheros3", type="string", length=255, nullable=true)
     */
    private $ficheros3;

    /**
     * @var string
     *
     * @ORM\Column(name="ficheros4", type="string", length=255, nullable=true)
     */
    private $ficheros4;

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
     * Set fecha
     *
     * @param string $fecha
     * @return Operaciones
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Operaciones
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
     * Set despacho
     *
     * @param string $despacho
     * @return Operaciones
     */
    public function setDespacho($despacho)
    {
        $this->despacho = $despacho;

        return $this;
    }

    /**
     * Get despacho
     *
     * @return string 
     */
    public function getDespacho()
    {
        return $this->despacho;
    }

    /**
     * Set nombresolicita
     *
     * @param string $nombresolicita
     * @return Operaciones
     */
    public function setNombresolicita($nombresolicita)
    {
        $this->nombresolicita = $nombresolicita;

        return $this;
    }

    /**
     * Get nombresolicita
     *
     * @return string 
     */
    public function getNombresolicita()
    {
        return $this->nombresolicita;
    }

    /**
     * Set cargosolicita
     *
     * @param string $cargosolicita
     * @return Operaciones
     */
    public function setCargosolicita($cargosolicita)
    {
        $this->cargosolicita = $cargosolicita;

        return $this;
    }

    /**
     * Get cargosolicita
     *
     * @return string 
     */
    public function getCargosolicita()
    {
        return $this->cargosolicita;
    }

    /**
     * Set presenciapais
     *
     * @param string $presenciapais
     * @return Operaciones
     */
    public function setPresenciapais($presenciapais)
    {
        $this->presenciapais = $presenciapais;

        return $this;
    }

    /**
     * Get presenciapais
     *
     * @return string 
     */
    public function getPresenciapais()
    {
        return $this->presenciapais;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Operaciones
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
     * Set montoestimado
     *
     * @param string $montoestimado
     * @return Operaciones
     */
    public function setMontoestimado($montoestimado)
    {
        $this->montoestimado = $montoestimado;

        return $this;
    }

    /**
     * Get montoestimado
     *
     * @return string 
     */
    public function getMontoestimado()
    {
        return $this->montoestimado;
    }

    /**
     * Set tecnologias
     *
     * @param string $tecnologias
     * @return Operaciones
     */
    public function setTecnologias($tecnologias)
    {
        $this->tecnologias = $tecnologias;

        return $this;
    }

    /**
     * Get tecnologias
     *
     * @return string 
     */
    public function getTecnologias()
    {
        return $this->tecnologias;
    }

    /**
     * Set experiencias
     *
     * @param string $experiencias
     * @return Operaciones
     */
    public function setExperiencias($experiencias)
    {
        $this->experiencias = $experiencias;

        return $this;
    }

    /**
     * Get experiencias
     *
     * @return string 
     */
    public function getExperiencias()
    {
        return $this->experiencias;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Operaciones
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
     * @return Operaciones
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
     * Set estado
     *
     * @param string $estado
     * @return Operaciones
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
     * @return Operaciones
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
     * Set organorelacion
     *
     * @param string $organorelacion
     * @return Operaciones
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
     * @return Operaciones
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
     * @return Operaciones
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
     * Set ficheros2
     *
     * @param string $ficheros2
     * @return Operaciones
     */
    public function setFicheros2($ficheros2)
    {
        $this->ficheros2 = $ficheros2;

        return $this;
    }

    /**
     * Get ficheros2
     *
     * @return string 
     */
    public function getFicheros2()
    {
        return $this->ficheros2;
    }

    /**
     * Set ficheros3
     *
     * @param string $ficheros3
     * @return Operaciones
     */
    public function setFicheros3($ficheros3)
    {
        $this->ficheros3 = $ficheros3;

        return $this;
    }

    /**
     * Get ficheros3
     *
     * @return string 
     */
    public function getFicheros3()
    {
        return $this->ficheros3;
    }

    /**
     * Set ficheros4
     *
     * @param string $ficheros4
     * @return Operaciones
     */
    public function setFicheros4($ficheros4)
    {
        $this->ficheros4 = $ficheros4;

        return $this;
    }

    /**
     * Get ficheros4
     *
     * @return string 
     */
    public function getFicheros4()
    {
        return $this->ficheros4;
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
     * @return Operaciones
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
