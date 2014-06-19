<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Huesped
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSE\ReservacionesBundle\Entity\HuespedRepository")
 */
class Huesped
{    
    public function __construct() {
	$this->reservaciones = new ArrayCollection();
    }
        
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=20)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=50)
     */
    private $correo;

    /**
     * @var integer
     *
     * @ORM\Column(name="celular", type="integer")
     */
    private $celular;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Reservacion", mappedBy="huesped")
     */
    private $reservaciones;

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
     * Set cedula
     *
     * @param string $cedula
     * @return Huesped
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string 
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Huesped
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
     * Set correo
     *
     * @param string $correo
     * @return Huesped
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set celular
     *
     * @param integer $celular
     * @return Huesped
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return integer 
     */
    public function getCelular()
    {
        return $this->celular;
    }
    
    /**
     * Get reservaciones
     *
     * @return array
     */
    public function getReservaciones()
    {
        return $this->reservaciones;
    }
}
