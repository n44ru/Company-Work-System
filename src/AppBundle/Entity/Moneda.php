<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moneda
 *
 * @ORM\Table(name="moneda", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Moneda
{
    /**
     * @var string
     *
     * @ORM\Column(name="moneda", type="string", length=255, nullable=true)
     */
    private $moneda;

    /**
     * @var string
     *
     * @ORM\Column(name="simbolo", type="string", length=10, nullable=true)
     */
    private $simbolo;

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
     * Set moneda
     *
     * @param string $moneda
     * @return Moneda
     */
    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return string 
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set simbolo
     *
     * @param string $simbolo
     * @return Moneda
     */
    public function setSimbolo($simbolo)
    {
        $this->simbolo = $simbolo;

        return $this;
    }

    /**
     * Get simbolo
     *
     * @return string 
     */
    public function getSimbolo()
    {
        return $this->simbolo;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Moneda
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
     * @return Moneda
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
}
