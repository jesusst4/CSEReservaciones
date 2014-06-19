<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicios_X_Reservacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSE\ReservacionesBundle\Entity\Servicios_X_ReservacionRepository")
 */
class Servicios_X_Reservacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_personas", type="smallint")
     */
    private $cantPersonas;

    /**
     * @var string
     *
     * @ORM\Column(name="subtotal", type="decimal", scale=2)
     */
    private $subtotal;
    
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Servicio", inversedBy="servicios_x_reservacion")
     * @ORM\JoinColumn(name="servicio_id", referencedColumnName="id")
     * */
    private $servicio;

    /**
     * @ORM\ManyToOne(targetEntity="Reservacion", inversedBy="servicios_x_reservacion")
     * @ORM\JoinColumn(name="reservacion_id", referencedColumnName="id")
     * */
    private $reservacion;
    


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
     * Set cantPersonas
     *
     * @param integer $cantPersonas
     * @return Servicios_X_Reservacion
     */
    public function setCantPersonas($cantPersonas)
    {
        $this->cantPersonas = $cantPersonas;

        return $this;
    }

    /**
     * Get cantPersonas
     *
     * @return integer 
     */
    public function getCantPersonas()
    {
        return $this->cantPersonas;
    }

    /**
     * Set subtotal
     *
     * @param string $subtotal
     * @return Servicios_X_Reservacion
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return string 
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }
    
    
    /**
     * Set servicio
     *
     * @param string $servicio
     * @return Servicios_X_Reservacion
     */
    public function setServicio($servicio) {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string 
     */
    public function getServicio() {
        return $this->servicio;
    }

    /**
     * Set reservacion
     *
     * @param string $reservacion
     * @return Servicios_X_Reservacion
     */
    public function setReservacion($reservacion) {
        $this->reservacion = $reservacion;

        return $this;
    }

    /**
     * Get reservacion
     *
     * @return string 
     */
    public function getReservacion() {
        return $this->reservacion;
    }
}
