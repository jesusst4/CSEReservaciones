<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReservacionesServises
 *
 * @author gvasquez
 */

namespace CSE\ReservacionesBundle\Services;

use Doctrine\ORM\EntityManager;

class ReservacionesServices {

    private $doctrine;

    public function __construct($service) {
        $this->doctrine = $service;
    }

    public function generarCodigo() {
        $cadena = "[^A-Z0-9]";
        $codigo = substr(preg_replace($cadena, "", md5(rand())) .
                preg_replace($cadena, "", md5(rand())) .
                preg_replace($cadena, "", md5(rand())), 0, 10);
        $codigo = strtoupper($codigo);
        $em = $this->doctrine->getManager();

        $resultado = $em->getRepository('CSEReservacionesBundle:Reservacion')->findByCodigo($codigo);

        if ($resultado === null) {
            $this->generarCodigo();
        } else {
            return $codigo;
        }
    }

    public function quitarActividadesXReservacion($id) {
        $this->getEntityManager()->createQuery("SELECT  ar FROM CSEReservacionesBundle:AtividadesXReservacion ar JOIN ar.reservacion r WHERE r.id = :id ")->setParameter('id', $id)->getResult();
    }

    public function quitarServiciosXReservacion($id) {
        $this->getEntityManager()->createQuery("SELECT  ar FROM CSEReservacionesBundle:AtividadesXReservacion ar JOIN ar.reservacion r WHERE r.id = :id ")->setParameter('id', $id)->getResult();
    }

}
