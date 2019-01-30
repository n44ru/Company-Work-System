<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 *
 * @ORM\Table(name="servicio", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKServicio117457", columns={"Monedaid"})})
 * @ORM\Entity
 */
class Servicio
{
    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="servicio", type="string", length=255, nullable=true)
     */
    private $servicio;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=true)
     */
    private $precio;

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
     * @var string
     *
     * @ORM\Column(name="actividades", type="string", length=255, nullable=true)
     */
    private $actividades;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Moneda
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Moneda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Monedaid", referencedColumnName="id")
     * })
     */
    private $monedaid;



    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Servicio
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set servicio
     *
     * @param string $servicio
     * @return Servicio
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string 
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Servicio
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
     * Set precio
     *
     * @param float $precio
     * @return Servicio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Servicio
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
     * @return Servicio
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
     * Set actividades
     *
     * @param string $actividades
     * @return Servicio
     */
    public function setActividades($actividades)
    {
        $this->actividades = $actividades;

        return $this;
    }

    /**
     * Get actividades
     *
     * @return string 
     */
    public function getActividades()
    {
        return $this->actividades;
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
     * Set monedaid
     *
     * @param \AppBundle\Entity\Moneda $monedaid
     * @return Servicio
     */
    public function setMonedaid(\AppBundle\Entity\Moneda $monedaid = null)
    {
        $this->monedaid = $monedaid;

        return $this;
    }

    /**
     * Get monedaid
     *
     * @return \AppBundle\Entity\Moneda 
     */
    public function getMonedaid()
    {
        return $this->monedaid;
    }
}
