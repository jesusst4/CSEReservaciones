<?php

namespace CSE\ReservacionesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AtividadesXReservacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AtividadesXReservacionRepository extends EntityRepository {

    public function actividadesXReservacion($id) {
        return $this->getEntityManager()->createQuery("SELECT  ar FROM CSEReservacionesBundle:AtividadesXReservacion ar JOIN ar.reservacion r WHERE r.id = :id ")->setParameter('id', $id)->getResult();
    }

    public function eliminarActividadesXReservacion($id) {
        return $this->getEntityManager()->createQuery("DELETE FROM CSEReservacionesBundle:AtividadesXReservacion ar WHERE ar.reservacion = :id ")->setParameter('id', $id)->execute();
    }
}
