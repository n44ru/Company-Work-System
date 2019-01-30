<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actserv
 *
 * @ORM\Table(name="actserv", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="FKActServ970353", columns={"Actividadesid"}), @ORM\Index(name="FKActServ91606", columns={"Servicioid"})})
 * @ORM\Entity
 */
class Actserv
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Actividades
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Actividades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Actividadesid", referencedColumnName="id")
     * })
     */
    private $actividadesid;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set actividadesid
     *
     * @param \AppBundle\Entity\Actividades $actividadesid
     * @return Actserv
     */
    public function setActividadesid(\AppBundle\Entity\Actividades $actividadesid = null)
    {
        $this->actividadesid = $actividadesid;

        return $this;
    }

    /**
     * Get actividadesid
     *
     * @return \AppBundle\Entity\Actividades 
     */
    public function getActividadesid()
    {
        return $this->actividadesid;
    }

    /**
     * Set servicioid
     *
     * @param \AppBundle\Entity\Servicio $servicioid
     * @return Actserv
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
}
