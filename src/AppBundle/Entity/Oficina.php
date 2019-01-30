<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oficina
 *
 * @ORM\Table(name="oficina", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKOficina248801", columns={"Trabajadoresid"})})
 * @ORM\Entity
 */
class Oficina
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
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

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
     * @var \AppBundle\Entity\Trabajadores
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trabajadores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Trabajadoresid", referencedColumnName="id")
     * })
     */
    private $trabajadoresid;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Oficina
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
     * Set direccion
     *
     * @param string $direccion
     * @return Oficina
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Oficina
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Oficina
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
     * @return Oficina
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
     * Set trabajadoresid
     *
     * @param \AppBundle\Entity\Trabajadores $trabajadoresid
     * @return Oficina
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
}
