<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table(name="factura", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKfactura27522", columns={"Presupuestoid"})})
 * @ORM\Entity
 */
class Factura
{
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
     * @ORM\Column(name="numero", type="string", length=255, nullable=true)
     */
    private $numero;

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
     * @ORM\Column(name="cobrado", type="string", length=255, nullable=true)
     */
    private $cobrado;

    /**
     * @var string
     *
     * @ORM\Column(name="Importe", type="string", length=255, nullable=true)
     */
    private $importe;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Presupuesto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Presupuesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Presupuestoid", referencedColumnName="id")
     * })
     */
    private $presupuestoid;



    /**
     * Set notas
     *
     * @param string $notas
     * @return Factura
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
     * @return Factura
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
     * Set numero
     *
     * @param string $numero
     * @return Factura
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fechainicio
     *
     * @param string $fechainicio
     * @return Factura
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
     * @return Factura
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
     * Set cobrado
     *
     * @param string $cobrado
     * @return Factura
     */
    public function setCobrado($cobrado)
    {
        $this->cobrado = $cobrado;

        return $this;
    }

    /**
     * Get cobrado
     *
     * @return string 
     */
    public function getCobrado()
    {
        return $this->cobrado;
    }

    /**
     * Set importe
     *
     * @param string $importe
     * @return Factura
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set presupuestoid
     *
     * @param \AppBundle\Entity\Presupuesto $presupuestoid
     * @return Factura
     */
    public function setPresupuestoid(\AppBundle\Entity\Presupuesto $presupuestoid = null)
    {
        $this->presupuestoid = $presupuestoid;

        return $this;
    }

    /**
     * Get presupuestoid
     *
     * @return \AppBundle\Entity\Presupuesto 
     */
    public function getPresupuestoid()
    {
        return $this->presupuestoid;
    }
}
