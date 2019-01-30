<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formapago
 *
 * @ORM\Table(name="formapago", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKFormaPago648544", columns={"Presupuestoid"})})
 * @ORM\Entity
 */
class Formapago
{
    /**
     * @var string
     *
     * @ORM\Column(name="formapago", type="string", length=255, nullable=true)
     */
    private $formapago;

    /**
     * @var string
     *
     * @ORM\Column(name="Importe", type="string", length=255, nullable=true)
     */
    private $importe;

    /**
     * @var string
     *
     * @ORM\Column(name="fechainicio", type="string", length=50, nullable=true)
     */
    private $fechainicio;

    /**
     * @var string
     *
     * @ORM\Column(name="fechafin", type="string", length=50, nullable=true)
     */
    private $fechafin;

    /**
     * @var float
     *
     * @ORM\Column(name="iva", type="float", precision=10, scale=0, nullable=true)
     */
    private $iva;

    /**
     * @var float
     *
     * @ORM\Column(name="gastossuplidos", type="float", precision=10, scale=0, nullable=true)
     */
    private $gastossuplidos;

    /**
     * @var float
     *
     * @ORM\Column(name="Total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

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
     * Set formapago
     *
     * @param string $formapago
     * @return Formapago
     */
    public function setFormapago($formapago)
    {
        $this->formapago = $formapago;

        return $this;
    }

    /**
     * Get formapago
     *
     * @return string 
     */
    public function getFormapago()
    {
        return $this->formapago;
    }

    /**
     * Set importe
     *
     * @param string $importe
     * @return Formapago
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
     * Set fechainicio
     *
     * @param string $fechainicio
     * @return Formapago
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
     * @return Formapago
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
     * Set iva
     *
     * @param float $iva
     * @return Formapago
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return float 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set gastossuplidos
     *
     * @param float $gastossuplidos
     * @return Formapago
     */
    public function setGastossuplidos($gastossuplidos)
    {
        $this->gastossuplidos = $gastossuplidos;

        return $this;
    }

    /**
     * Get gastossuplidos
     *
     * @return float 
     */
    public function getGastossuplidos()
    {
        return $this->gastossuplidos;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Formapago
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
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
     * @return Formapago
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
