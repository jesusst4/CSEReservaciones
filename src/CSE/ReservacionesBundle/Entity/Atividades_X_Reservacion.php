<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atividades_X_Reservacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSE\ReservacionesBundle\Entity\Atividades_X_ReservacionRepository")
 */
class Atividades_X_Reservacion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

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
     * @ORM\ManyToOne(targetEntity="Actividad", inversedBy="actividades_x_reservacion")
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id")
     * */
    private $actividad;

    /**
     * @ORM\ManyToOne(targetEntity="Reservacion", inversedBy="actividades_x_reservacion")
     * @ORM\JoinColumn(name="reservacion_id", referencedColumnName="id")
     * */
    private $reservacion;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Atividades_X_Reservacion
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set cantPersonas
     *
     * @param integer $cantPersonas
     * @return Atividades_X_Reservacion
     */
    public function setCantPersonas($cantPersonas) {
        $this->cantPersonas = $cantPersonas;

        return $this;
    }

    /**
     * Get cantPersonas
     *
     * @return integer 
     */
    public function getCantPersonas() {
        return $this->cantPersonas;
    }

    /**
     * Set subtotal
     *
     * @param string $subtotal
     * @return Atividades_X_Reservacion
     */
    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return string 
     */
    public function getSubtotal() {
        return $this->subtotal;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     * @return Atividades_X_Reservacion
     */
    public function setActividad($actividad) {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string 
     */
    public function getActividad() {
        return $this->actividad;
    }

    /**
     * Set reservacion
     *
     * @param string $reservacion
     * @return Atividades_X_Reservacion
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
