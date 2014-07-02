<?php

namespace CSE\ReservacionesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CSE\ReservacionesBundle\Entity\Reservacion;
use CSE\ReservacionesBundle\Form\ReservacionType;
use CSE\ReservacionesBundle\Entity\Huesped;
use CSE\ReservacionesBundle\Entity\AtividadesXReservacion;
use CSE\ReservacionesBundle\Entity\ActividadRepository;
use CSE\ReservacionesBundle\Entity\Servicio;
use CSE\ReservacionesBundle\Entity\ServiciosXReservacion;

/**
 * Reservacion controller.
 *
 */
class ReservacionController extends Controller {

    /**
     * Lists all Reservacion entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();

        return $this->render('CSEReservacionesBundle:Reservacion:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Reservacion entity.
     *
     */
    public function createAction(Request $request) {
        $reservacion = new Reservacion();
        $form = $this->createCreateForm($reservacion);

        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        $listaHabitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->consultaPrecios();
        $listaHabitacionesSe = json_encode($listaHabitaciones);
        if ($form->isValid()) {

            $huesped = new Huesped();
            $huesped = $reservacion->getHuesped();
            $em->persist($huesped);
            $reservacion->setHuesped($huesped);

            $em->persist($reservacion);
            $em->flush();

            return $this->redirect($this->generateUrl('reservacion_servicios', array('id' => $reservacion->getId())));
        }

        return $this->render('CSEReservacionesBundle:Reservacion:new.html.twig', array(
                    'entity' => $reservacion,
                    'form' => $form->createView(),
                    'habitaciones' => $listaHabitacionesSe
        ));
    }

    /**
     * Creates a form to create a Reservacion entity.
     *
     * @param Reservacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reservacion $entity) {
        $form = $this->createForm(new ReservacionType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Servicios', 'attr' => array('class' => 'btn'),));
        return $form;
    }

    /**
     * Displays a form to create a new Reservacion entity.
     *
     */
    public function newAction() {
        $entity = new Reservacion();
        $entity->setCodigo($this->get('reservacionesServices')->generarCodigo());
        $form = $this->createCreateForm($entity);
        $huesped = new Huesped();
        $entity->setHuesped($huesped);

        $em = $this->getDoctrine()->getManager();

        $listaHabitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->consultaPrecios();
        $listaHabitacionesSe = json_encode($listaHabitaciones);
        return $this->render('CSEReservacionesBundle:Reservacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'huesped' => $huesped,
                    'habitaciones' => $listaHabitacionesSe
        ));
    }

    /**
     * Finds and displays a Reservacion entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CSEReservacionesBundle:Reservacion:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Reservacion entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $listaHabitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->consultaPrecios();
        $listaHabitacionesSe = json_encode($listaHabitaciones);

        $entities = $em->getRepository('CSEReservacionesBundle:Actividad')->findAll();
        $actividadRepo = $em->getRepository("CSEReservacionesBundle:Actividad");
        $listaActividades = $actividadRepo->listarActividades();
        $actResRepo1 = $em->getRepository("CSEReservacionesBundle:AtividadesXReservacion");
        $lActivReserv = $actResRepo1->actividadesXReservacion($id);
        $listaActividadesCod = json_encode($listaActividades);

        $listaServicios = $em->getRepository('CSEReservacionesBundle:Servicio')->findAll();
        $listaPrecios = $em->getRepository('CSEReservacionesBundle:Servicio')->consultaPrecios();
        $actResRepo2 = $em->getRepository("CSEReservacionesBundle:ServiciosXReservacion");
        $lServReserv = $actResRepo2->serviciosXReservacion($id);
        $listaPreciosSe = json_encode($listaPrecios);

        return $this->render('CSEReservacionesBundle:Reservacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'habitaciones' => $listaHabitacionesSe,
                    'actividades' => $listaActividadesCod,
                    'entities' => $entities,
                    'servicios' => $listaServicios,
                    'listaPrecios' => $listaPreciosSe,
                    'actvsReserv' => $lActivReserv,
                    'servsReserv' => $lServReserv
        ));
    }

    /**
     * Creates a form to edit a Reservacion entity.
     *
     * @param Reservacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Reservacion $entity) {
        $form = $this->createForm(new ReservacionType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Modificar', 'attr' => array('class' => 'btn')));

        return $form;
    }

    /**
     * Edits an existing Reservacion entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $reservGuardadas = array();
            $actResRepo1 = $em->getRepository('CSEReservacionesBundle:AtividadesXReservacion');
            $reservGuardadas = $actResRepo1->idActividadesXReservacion($id);
            
            $reservMarcadas = array();
            $reservMarcadas = $request->request->get("actividad");
            
            array_values($reservGuardadas);
            var_dump(array_values($reservGuardadas));
//            print_r($reservGuardadas);
            $resEliminar = array_diff($reservGuardadas, $reservMarcadas); 
            $resGuardar = array_diff($reservMarcadas, $reservGuardadas);
            
            foreach ($resEliminar as $value) {
                $entityReservacion = $em->getRepository('CSEReservacionesBundle:AtividadesXReservacion')->find($value);
                $em ->remove($entityReservacion);
                $em ->flush();
            }
            
            
            
//            echo gettype($actividades)." actividades";
//            $entityReservacion = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);
//            $cantidad = count($actividades);
//            $subtotalActividades = 0;
//
//            foreach ($actividades as $kay => $value) {
//                $AtividadesXReservacion = new AtividadesXReservacion();
//                $entityActividad = $em->getRepository('CSEReservacionesBundle:Actividad')->find($value);
//                $AtividadesXReservacion->setActividad($entityActividad);
//                $AtividadesXReservacion->setReservacion($entityReservacion);
//                $AtividadesXReservacion->setCantPersonas($request->request->get("cantPer" . $value));
//                $AtividadesXReservacion->setSubtotal($request->request->get("cantPer" . $value) * $request->request->get("precio" . $value));
//                $date = $request->request->get("fecha" . $value);
//                $AtividadesXReservacion->setFecha(new \DateTime($date));
//                array_push($reservMarcadas, $AtividadesXReservacion);
//
//                $subtotalActividades += $request->request->get("cantPer" . $value) * $request->request->get("precio" . $value);
//            }
//
//            echo ' sjdfs2 ' . gettype($reservMarcadas);
//            $array1 = array("a" => "green", "red", "blue", "red",array("a" => "green", "red", "blue", "red"));
//            $array2 = array("b" => "green", "yellow", "red", array("a" => "green", "red", "blue", "red"));
//            $resultado = array_diff($array1, $array2);
//            echo gettype($resultado)."  resultado";
//
//            print_r($resultado);
//
//            $aGuardar = array_diff($reservGuardadas, $reservMarcadas);
//            $aEliminar = array_diff($reservGuardadas, $reservMarcadas);
//
////            foreach ($aGuardar as $key => $value) {
////            }
////            foreach ($aEliminar as $key => $value) {
////                
////            }
//
//            $entityReservacion->setSubtotalActividades($subtotalActividades);
//            $em->flush();

            return $this->redirect($this->generateUrl('reservacion_edit', array('id' => $id)));
        }

        $listaHabitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->consultaPrecios();
        $listaHabitacionesSe = json_encode($listaHabitaciones);

        return $this->render('CSEReservacionesBundle:Reservacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'habitaciones' => $listaHabitacionesSe
        ));
    }

    /**
     * Deletes a Reservacion entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reservacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reservacion'));
    }

    /**
     * Creates a form to delete a Reservacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reservacion_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    public function addActividadesAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CSEReservacionesBundle:Actividad')->findAll();

        $actividadRepo = $em->getRepository("CSEReservacionesBundle:Actividad");
        $listaActividades = $actividadRepo->listarActividades();

        $listaActividadesCod = json_encode($listaActividades);

        return $this->render('CSEReservacionesBundle:Actividad:index.html.twig', array(
                    'entities' => $entities, 'id' => $id, 'actividades' => $listaActividadesCod
        ));
    }

    public function saveActividadesAction(Request $request, $id) {
        $actividades = $request->request->get("actividad");

        $em = $this->getDoctrine()->getManager();
        $entityReservacion = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);
        $cantidad = count($actividades);
        $subtotalActividades = 0;

        foreach ($actividades as $kay => $value) {
            $entity = new AtividadesXReservacion();
            $entityActividad = $em->getRepository('CSEReservacionesBundle:Actividad')->find($value);
            $entity->setActividad($entityActividad);
            $entity->setReservacion($entityReservacion);
            $entity->setCantPersonas($request->request->get("cantPer" . $value));
            $entity->setSubtotal($request->request->get("cantPer" . $value) * $request->request->get("precio" . $value));

            $subtotalActividades += $request->request->get("cantPer" . $value) * $request->request->get("precio" . $value);

            $date = $request->request->get("fecha" . $value);
            $entity->setFecha(new \DateTime($date));
            $em->persist($entity);
        }
        $entityReservacion->setSubtotalActividades($subtotalActividades);

        $em->flush();

        return $this->redirect($this->generateUrl('reservacion'));
    }

    public function serviciosAction($id) {

        $em = $this->getDoctrine()->getManager();
        $listaServicios = $em->getRepository('CSEReservacionesBundle:Servicio')->findAll();

        $listaPrecios = $em->getRepository('CSEReservacionesBundle:Servicio')->consultaPrecios();
        $listaPreciosSe = json_encode($listaPrecios);

        return $this->render('CSEReservacionesBundle:Reservacion:servicios.html.twig', array(
                    'entity' => $id,
                    'servicios' => $listaServicios,
                    'listaPrecios' => $listaPreciosSe
        ));
    }

    public function agregarServiciosAction(Request $request, $id) {

        $servicios = $request->request->get("serviciosSe");

        $em = $this->getDoctrine()->getManager();
        $entityReservacion = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);
        $subtServicios = $request->request->get("totalServicios");
        $entityReservacion->setSubtotalServicios($subtServicios);
        $em->persist($entityReservacion);
        foreach ($servicios as $value) {
            $entityServicio = $em->getRepository('CSEReservacionesBundle:Servicio')->find($value);
            if ($entityServicio->getRequiereCant() == 1) {
                $cantidadPer = $request->request->get("canPersonas" . $value);
//                if ($cantidadPer != "") {
                $entity = new ServiciosXReservacion();

                $entity->setServicio($entityServicio);
                $entity->setReservacion($entityReservacion);
                $entity->setCantPersonas($request->request->get("canPersonas" . $value));

                $entity->setSubtotal($request->request->get("canPersonas" . $value) * $entityServicio->getPrecio());
                $em->persist($entity);
//                }
            } else {
                $entity = new ServiciosXReservacion();

                $entity->setServicio($entityServicio);
                $entity->setReservacion($entityReservacion);
                $entity->setSubtotal($entityServicio->getPrecio());
                $em->persist($entity);
            }
        }


        $em->flush();

        return $this->redirect($this->generateUrl('reservacion_add_actividades', array('id' => $id)));
    }

    public function buscarAction(Request $request) {

        if ($request->request->get("txtCodigo") != "" || $request->request->get("txtCliente") != "") {
            $codigo = $request->request->get("txtCodigo");
            $cliente = $request->request->get("txtCliente");
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->consultarReservacion($codigo, $cliente);
            return $this->render('CSEReservacionesBundle:Reservacion:buscarReservacion.html.twig', array('codigo' => $codigo, 'cliente' => $cliente, 'entities' => $entity));
        }
        return $this->render('CSEReservacionesBundle:Reservacion:buscarReservacion.html.twig', array('codigo' => '', 'cliente' => '', 'entities' => null));
    }

    public function reporteReservacionesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $habitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->findAll();

        if ($request->request->get("txtTipoHabitacion") != null) {

            $em = $this->getDoctrine()->getManager();
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($request->request->get("txtTipoHabitacion"));
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($request->request->get("txtTipoHabitacion"));
            $total1 = $total[0];
            $totalRe = $total1['total'];
            return $this->render('CSEReservacionesBundle:Reservacion:reporteReservaciones.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe));
        } else {

            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
            return $this->render('CSEReservacionesBundle:Reservacion:reporteReservaciones.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe));
        }
    }

    public function reporteGananciasAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $habitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->findAll();

        if ($request->request->get("txtTipoHabitacion") != null) {

            $em = $this->getDoctrine()->getManager();
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($request->request->get("txtTipoHabitacion"));
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($request->request->get("txtTipoHabitacion"));
            $total1 = $total[0];
            $totalRe = $total1['total'];
            return $this->render('CSEReservacionesBundle:Reservacion:reporteGanancias.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe));
        } else {

            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
            return $this->render('CSEReservacionesBundle:Reservacion:reporteGanancias.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe));
        }
    }

}
