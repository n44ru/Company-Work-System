<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_razonsocial", type="string", length=255, nullable=true)
     */
    private $nombreRazonsocial;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion_fisica", type="string", length=255, nullable=true)
     */
    private $identificacionFisica;

    /**
     * @var string
     *
     * @ORM\Column(name="objetosocial", type="string", length=255, nullable=true)
     */
    private $objetosocial;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=255, nullable=true)
     */
    private $grupo;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255, nullable=true)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="string", length=255, nullable=true)
     */
    private $actividad;

    /**
     * @var string
     *
     * @ORM\Column(name="presidente", type="string", length=255, nullable=true)
     */
    private $presidente;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer", nullable=true)
     */
    private $telefono;

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
     * Set nombreRazonsocial
     *
     * @param string $nombreRazonsocial
     * @return Persona
     */
    public function setNombreRazonsocial($nombreRazonsocial)
    {
        $this->nombreRazonsocial = $nombreRazonsocial;

        return $this;
    }

    /**
     * Get nombreRazonsocial
     *
     * @return string 
     */
    public function getNombreRazonsocial()
    {
        return $this->nombreRazonsocial;
    }

    /**
     * Set identificacionFisica
     *
     * @param string $identificacionFisica
     * @return Persona
     */
    public function setIdentificacionFisica($identificacionFisica)
    {
        $this->identificacionFisica = $identificacionFisica;

        return $this;
    }

    /**
     * Get identificacionFisica
     *
     * @return string 
     */
    public function getIdentificacionFisica()
    {
        return $this->identificacionFisica;
    }

    /**
     * Set objetosocial
     *
     * @param string $objetosocial
     * @return Persona
     */
    public function setObjetosocial($objetosocial)
    {
        $this->objetosocial = $objetosocial;

        return $this;
    }

    /**
     * Get objetosocial
     *
     * @return string 
     */
    public function getObjetosocial()
    {
        return $this->objetosocial;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     * @return Persona
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Persona
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
     * Set ciudad
     *
     * @param string $ciudad
     * @return Persona
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Persona
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Persona
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Persona
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
     * Set email
     *
     * @param string $email
     * @return Persona
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
     * Set actividad
     *
     * @param string $actividad
     * @return Persona
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string 
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set presidente
     *
     * @param string $presidente
     * @return Persona
     */
    public function setPresidente($presidente)
    {
        $this->presidente = $presidente;

        return $this;
    }

    /**
     * Get presidente
     *
     * @return string 
     */
    public function getPresidente()
    {
        return $this->presidente;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Persona
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Persona
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
     * @return Persona
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
