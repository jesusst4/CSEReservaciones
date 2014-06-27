<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSE\ReservacionesBundle\Entity\ServicioRepository")
 */
class Servicio {

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
     * @ORM\Column(name="tipo", type="string", length=100)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="precio", type="decimal", scale=2)
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_cant", type="smallint")
     */
    private $requiereCant;

    /**
     * @ORM\OneToMany(targetEntity="ServiciosXReservacion", mappedBy="servicio", cascade={"all"})
     * */
    private $servicios_x_reservacion;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Servicio
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     * @return Servicio
     */
    public function setPrecio($precio) {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return integer 
     */
    public function getPrecio() {
        return $this->precio;
    }

    /**
     * Set requiereCant
     *
     * @param string $requiereCant
     * @return Servicio
     */
    public function setRequiereCant($requiereCant) {
        $this->requiereCant = $requiereCant;

        return $this;
    }

    /**
     * Get requiereCant
     *
     * @return string 
     */
    public function getRequiereCant() {
        return $this->requiereCant;
    }

}
