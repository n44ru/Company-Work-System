<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuesto
 *
 * @ORM\Table(name="presupuesto", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKPresupuest589995", columns={"Trabajadoresid"}), @ORM\Index(name="FKPresupuest289782", columns={"Personaid"}), @ORM\Index(name="FKPresupuest151853", columns={"Empresaid"}), @ORM\Index(name="FKPresupuest87551", columns={"Monedaid"}), @ORM\Index(name="FKPresupuest288909", columns={"Oficinaid"}), @ORM\Index(name="FKPresupuest392072", columns={"Servicioid"})})
 * @ORM\Entity
 */
class Presupuesto
{
    /**
     * @var string
     *
     * @ORM\Column(name="Fechainicio", type="string", length=255, nullable=true)
     */
    private $fechainicio;

    /**
     * @var string
     *
     * @ORM\Column(name="Fechafin", type="string", length=255, nullable=true)
     */
    private $fechafin;

    /**
     * @var string
     *
     * @ORM\Column(name="Objetivos", type="string", length=255, nullable=true)
     */
    private $objetivos;

    /**
     * @var float
     *
     * @ORM\Column(name="Importe", type="float", precision=10, scale=0, nullable=true)
     */
    private $importe;

    /**
     * @var string
     *
     * @ORM\Column(name="Descuento", type="string", length=255, nullable=true)
     */
    private $descuento;

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
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
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
     * @var \AppBundle\Entity\Trabajadores
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trabajadores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Trabajadoresid", referencedColumnName="id")
     * })
     */
    private $trabajadoresid;

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
     * @var \AppBundle\Entity\Servicio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Servicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Servicioid", referencedColumnName="id")
     * })
     */
    private $servicioid;

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
     * @var \AppBundle\Entity\Empresa
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Empresaid", referencedColumnName="id")
     * })
     */
    private $empresaid;



    /**
     * Set fechainicio
     *
     * @param string $fechainicio
     * @return Presupuesto
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
     * @return Presupuesto
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
     * Set objetivos
     *
     * @param string $objetivos
     * @return Presupuesto
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
     * @param float $importe
     * @return Presupuesto
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return float 
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     * @return Presupuesto
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Presupuesto
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
     * @return Presupuesto
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
     * Set iva
     *
     * @param float $iva
     * @return Presupuesto
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
     * @return Presupuesto
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
     * @return Presupuesto
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
     * Set trabajadoresid
     *
     * @param \AppBundle\Entity\Trabajadores $trabajadoresid
     * @return Presupuesto
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
     * Set monedaid
     *
     * @param \AppBundle\Entity\Moneda $monedaid
     * @return Presupuesto
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

    /**
     * Set servicioid
     *
     * @param \AppBundle\Entity\Servicio $servicioid
     * @return Presupuesto
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

    /**
     * Set personaid
     *
     * @param \AppBundle\Entity\Persona $personaid
     * @return Presupuesto
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
     * @return Presupuesto
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
     * Set empresaid
     *
     * @param \AppBundle\Entity\Empresa $empresaid
     * @return Presupuesto
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
}
