<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domiciliosocial
 *
 * @ORM\Table(name="domiciliosocial", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKDomicilioS350417", columns={"Personaid"}), @ORM\Index(name="FKDomicilioS179538", columns={"Empresaid"})})
 * @ORM\Entity
 */
class Domiciliosocial
{
    /**
     * @var string
     *
     * @ORM\Column(name="domiciliosocial", type="string", length=255, nullable=true)
     */
    private $domiciliosocial;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255, nullable=true)
     */
    private $fecha;

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
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Personaid", referencedColumnName="id")
     * })
     */
    private $personaid;

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
     * Set domiciliosocial
     *
     * @param string $domiciliosocial
     * @return Domiciliosocial
     */
    public function setDomiciliosocial($domiciliosocial)
    {
        $this->domiciliosocial = $domiciliosocial;

        return $this;
    }

    /**
     * Get domiciliosocial
     *
     * @return string 
     */
    public function getDomiciliosocial()
    {
        return $this->domiciliosocial;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return Domiciliosocial
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
     * Set notas
     *
     * @param string $notas
     * @return Domiciliosocial
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
     * @return Domiciliosocial
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
     * Set personaid
     *
     * @param \AppBundle\Entity\Persona $personaid
     * @return Domiciliosocial
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
     * Set empresaid
     *
     * @param \AppBundle\Entity\Empresa $empresaid
     * @return Domiciliosocial
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
