<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cambio
 *
 * @ORM\Table(name="cambio", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKCambio891030", columns={"Monedaid"})})
 * @ORM\Entity
 */
class Cambio
{
    /**
     * @var float
     *
     * @ORM\Column(name="tasa", type="float", precision=10, scale=0, nullable=false)
     */
    private $tasa;

    /**
     * @var string
     *
     * @ORM\Column(name="Monedacambio", type="string", length=50, nullable=false)
     */
    private $monedacambio;

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
     * Set tasa
     *
     * @param float $tasa
     * @return Cambio
     */
    public function setTasa($tasa)
    {
        $this->tasa = $tasa;

        return $this;
    }

    /**
     * Get tasa
     *
     * @return float 
     */
    public function getTasa()
    {
        return $this->tasa;
    }

    /**
     * Set monedacambio
     *
     * @param string $monedacambio
     * @return Cambio
     */
    public function setMonedacambio($monedacambio)
    {
        $this->monedacambio = $monedacambio;

        return $this;
    }

    /**
     * Get monedacambio
     *
     * @return string 
     */
    public function getMonedacambio()
    {
        return $this->monedacambio;
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
     * @return Cambio
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
