<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Legislacion
 *
 * @ORM\Table(name="legislacion", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKLegislacio731331", columns={"LTiposid"})})
 * @ORM\Entity
 */
class Legislacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

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
     * @var \AppBundle\Entity\Ltipos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ltipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LTiposid", referencedColumnName="id")
     * })
     */
    private $ltiposid;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Legislacion
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
     * Set notas
     *
     * @param string $notas
     * @return Legislacion
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
     * @return Legislacion
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
     * Set ltiposid
     *
     * @param \AppBundle\Entity\Ltipos $ltiposid
     * @return Legislacion
     */
    public function setLtiposid(\AppBundle\Entity\Ltipos $ltiposid = null)
    {
        $this->ltiposid = $ltiposid;

        return $this;
    }

    /**
     * Get ltiposid
     *
     * @return \AppBundle\Entity\Ltipos 
     */
    public function getLtiposid()
    {
        return $this->ltiposid;
    }
}
