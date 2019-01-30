<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actascuentas
 *
 * @ORM\Table(name="actascuentas", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKActasCuent625485", columns={"Personaid"}), @ORM\Index(name="FKActasCuent95530", columns={"Empresaid"})})
 * @ORM\Entity
 */
class Actascuentas
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

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
     * @var \AppBundle\Entity\Empresa
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Empresaid", referencedColumnName="id")
     * })
     */
    private $empresaid;

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
     * Set notas
     *
     * @param string $notas
     * @return Actascuentas
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
     * Set nombre
     *
     * @param string $nombre
     * @return Actascuentas
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
     * Set fichero
     *
     * @param string $fichero
     * @return Actascuentas
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
     * Set empresaid
     *
     * @param \AppBundle\Entity\Empresa $empresaid
     * @return Actascuentas
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

    /**
     * Set personaid
     *
     * @param \AppBundle\Entity\Persona $personaid
     * @return Actascuentas
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
}
