<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Habitacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSE\ReservacionesBundle\Entity\HabitacionRepository")
 */
class Habitacion
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
     * @ORM\Column(name="tipo", type="string", length=50)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", scale=2)
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacidad", type="smallint")
     */
    private $capacidad;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Reservacion", mappedBy="habitacion")
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
     * Set tipo
     *
     * @param string $tipo
     * @return Habitacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Habitacion
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set capacidad
     *
     * @param integer $capacidad
     * @return Habitacion
     */
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    /**
     * Get capacidad
     *
     * @return integer 
     */
    public function getCapacidad()
    {
        return $this->capacidad;
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
