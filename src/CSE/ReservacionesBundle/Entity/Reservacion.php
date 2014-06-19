<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use CSE\ReservacionesBundle\Entity\Atividades_X_Reservacion;
use CSE\ReservacionesBundle\Entity\Servicios_X_Reservacion;

/**
 * Reservacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSE\ReservacionesBundle\Entity\ReservacionRepository")
 */
class Reservacion {

    public function __construct() {
        $this->actividades = new ArrayCollection();
        $this->actividades_x_reservacion = new ArrayCollection();
        $this->servicio= new ArrayCollection();
        $this->servicios_x_reservacion= new ArrayCollection();
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
     * @ORM\Column(name="codigo", type="string", length=10)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_personas", type="smallint")
     */
    private $cantPersonas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date")
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="date")
     */
    private $fechaSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="total_reservacion", type="decimal", scale=2)
     */
    private $totalReservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="subtotal_servicios", type="decimal", scale=2)
     */
    private $subtotalServicios;

    /**
     * @var string
     *
     * @ORM\Column(name="subtotal_actividades", type="decimal", scale=2)
     */
    private $subtotalActividades;

    /**
     * @ORM\ManyToOne(targetEntity="Habitacion", inversedBy="reservaciones")
     * @ORM\JoinColumn(name="habitacion_id", referencedColumnName="id")
     * */
    private $habitacion;

    /**
     * @ORM\ManyToOne(targetEntity="Huesped", inversedBy="reservaciones")
     * @ORM\JoinColumn(name="huesped_id", referencedColumnName="id")
     * */
    private $huesped;

    /**
     * @ORM\OneToMany(targetEntity="Atividades_X_Reservacion", mappedBy="reservacion", cascade={"all"})
     * */
    private $actividades_x_reservacion;
    
    private $actividades;
    
    
    
     /**
     * @ORM\OneToMany(targetEntity="Servicios_X_Reservacion", mappedBy="reservacion", cascade={"all"})
     * */
    private $servicios_x_reservacion;
    
    private $servicio;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Reservacion
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo() {
        return $this->codigo;
    }

    /**
     * Set cantPersonas
     *
     * @param integer $cantPersonas
     * @return Reservacion
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
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return Reservacion
     */
    public function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     * @return Reservacion
     */
    public function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime 
     */
    public function getFechaSalida() {
        return $this->fechaSalida;
    }

    /**
     * Set totalReservacion
     *
     * @param string $totalReservacion
     * @return Reservacion
     */
    public function setTotalReservacion($totalReservacion) {
        $this->totalReservacion = $totalReservacion;

        return $this;
    }

    /**
     * Get totalReservacion
     *
     * @return string 
     */
    public function getTotalReservacion() {
        return $this->totalReservacion;
    }

    /**
     * Set subtotalServicios
     *
     * @param string $subtotalServicios
     * @return Reservacion
     */
    public function setSubtotalServicios($subtotalServicios) {
        $this->subtotalServicios = $subtotalServicios;

        return $this;
    }

    /**
     * Get subtotalServicios
     *
     * @return string 
     */
    public function getSubtotalServicios() {
        return $this->subtotalServicios;
    }

    /**
     * Set subtotalActividades
     *
     * @param string $subtotalActividades
     * @return Reservacion
     */
    public function setSubtotalActividades($subtotalActividades) {
        $this->subtotalActividades = $subtotalActividades;

        return $this;
    }

    /**
     * Get subtotalActividades
     *
     * @return string 
     */
    public function getSubtotalActividades() {
        return $this->subtotalActividades;
    }

    /**
     * Set habitacion
     *
     * @param string $habitacion
     * @return Reservacion
     */
    public function setHabitacion($habitacion) {
        $this->habitacion = $habitacion;

        return $this;
    }

    /**
     * Get habitacion
     *
     * @return string 
     */
    public function getHabitacion() {
        return $this->habitacion;
    }

    /**
     * Set huesped
     *
     * @param string huesped
     * @return Reservacion
     */
    public function setHuesped($huesped) {
        $this->huesped = $huesped;

        return $this;
    }

    /**
     * Get huesped
     *
     * @return string 
     */
    public function getHuesped() {
        return $this->huesped;
    }
    
    // Important 
    public function getActividad()
    {
        $actividades = new ArrayCollection();
        
        foreach($this->actividades_x_reservacion as $ar)
        {
            $actividades[] = $ar->getActividad();
        }

        return $actividades;
    }
    // Important
    public function setActividad($actividades)
    {
        foreach($actividades as $a)
        {
            $ar = new Atividades_X_Reservacion();

            $ar->setReservacion($this);
            $ar->setActividad($a);

            $this->addActividadXReservacion($ar);
        }

    }


    public function addActividadXReservacion($actividadReservacion)
    {
        $this->actividades_x_reservacion[] = $actividadReservacion;
    }
    
    public function removeActividadXReservacion($actividadReservacion)
    {
        return $this->actividades_x_reservacion->removeElement($actividadReservacion);
    }

    
    
    // Important 
    public function getServicio()
    {
        $servicios = new ArrayCollection();
        
        foreach($this->servicios_x_reservacion as $sr)
        {
            $servicios[] = $sr->getServicio();
        }

        return $servicios;
    }
    // Important
    public function setServicio($servicios)
    {
        foreach($servicios as $s)
        {
            $sr = new Servicios_X_Reservacion();

            $sr->setReservacion($this);
            $sr->setServicio($s);

            $this->addServiciosXReservacion($sr);
        }

    }

    public function addServiciosXReservacion($servicioReservacion)
    {
        $this->servicios_x_reservacion[] = $servicioReservacion;
    }
    
    public function removeServiciosXReservacion($servicioReservacion)
    {
        return $this->servicios_x_reservacion->removeElement($servicioReservacion);
    }

    
}
