<?php

namespace CSE\ReservacionesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CSE\ReservacionesBundle\Entity\Reservacion;
use CSE\ReservacionesBundle\Form\ReservacionType;
use CSE\ReservacionesBundle\Entity\Huesped;
use CSE\ReservacionesBundle\Entity\AtividadesXReservacion;
use CSE\ReservacionesBundle\Entity\ActividadRepository;
use CSE\ReservacionesBundle\Entity\Servicio;
use CSE\ReservacionesBundle\Entity\ServiciosXReservacion;
use Ps\PdfBundle\Annotation\Pdf;
use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;
use ZendPdf\Style;

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

        $servicios = $em->getRepository('CSEReservacionesBundle:ServiciosXReservacion')->serviciosXReservacion($id);
        $actividades = $em->getRepository('CSEReservacionesBundle:AtividadesXReservacion')->actividadesXReservacion($id);

        return $this->render('CSEReservacionesBundle:Reservacion:show.html.twig', array(
                    'entity' => $entity,
                    'servicios' => $servicios,
                    'actividades' => $actividades
        ));
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
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CSEReservacionesBundle:Reservacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
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
        $form = $this->createForm(new ReservacionType(), $entity, array(
            'action' => $this->generateUrl('reservacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

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

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('reservacion_edit', array('id' => $id)));
        }

        return $this->render('CSEReservacionesBundle:Reservacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Reservacion entity.
     *
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservacion entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('principal'));
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
                        ->setMethod('GET')
                        ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'btnTotal'),))
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

        return $this->redirect($this->generateUrl('principal'));
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
        $entityReservacion->setSubtotalServicios($request->request->get("totalServicios"));
        $em->persist($entityReservacion);

        foreach ($servicios as $value) {

            $entityServicio = $em->getRepository('CSEReservacionesBundle:Servicio')->find($value);
            $entity = new ServiciosXReservacion();
            $entity->setServicio($entityServicio);
            $entity->setReservacion($entityReservacion);

            if ($entityServicio->getRequiereCant() == 1) {

                $entity->setCantPersonas($request->request->get("canPersonas" . $value));
                $entity->setSubtotal($request->request->get("canPersonas" . $value) * $entityServicio->getPrecio());
            } else {

                $entity->setSubtotal($entityServicio->getPrecio());
            }
            $em->persist($entity);
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
        $filtro = 0;
        if ($request->request->get("txtTipoHabitacion") != null) {

            $em = $this->getDoctrine()->getManager();
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($request->request->get("txtTipoHabitacion"));
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($request->request->get("txtTipoHabitacion"));
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $filtro = $request->request->get("txtTipoHabitacion");
            return $this->render('CSEReservacionesBundle:Reservacion:reporteReservaciones.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe, 'filtro' => $filtro));
        } else {

            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
            return $this->render('CSEReservacionesBundle:Reservacion:reporteReservaciones.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe, 'filtro' => $filtro));
        }
    }

    public function reporteGananciasAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $habitaciones = $em->getRepository('CSEReservacionesBundle:Habitacion')->findAll();
        $filtro = 0;
        if ($request->request->get("txtTipoHabitacion") != null) {

            $em = $this->getDoctrine()->getManager();
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($request->request->get("txtTipoHabitacion"));
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($request->request->get("txtTipoHabitacion"));
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $filtro = $request->request->get("txtTipoHabitacion");
            return $this->render('CSEReservacionesBundle:Reservacion:reporteGanancias.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe, 'filtro' => $filtro));
        } else {

            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
            return $this->render('CSEReservacionesBundle:Reservacion:reporteGanancias.html.twig', array('habitaciones' => $habitaciones, 'reservaciones' => $reservaciones, 'total' => $totalRe, 'filtro' => $filtro));
        }
    }

    public function envioReservacionAction($id) {
        $this->get('enviarEmailServices')->enviarReservacion($id);


        return $this->redirect($this->generateUrl('principal'));
    }

    public function envioReservacionesAction(Request $request) {

        $this->get('enviarEmailServices')->enviarReporteReservaciones($request->request->get("filtro"), $request->request->get("txtCorreo"));

        return $this->redirect($this->generateUrl('principal'));
    }

    public function envioGananciasAction(Request $request) {

        echo '' . $request->request->get("filtro");
        $this->get('enviarEmailServices')->enviarReporteGanancias($request->request->get("filtro"), $request->request->get("txtCorreo"));

        return $this->redirect($this->generateUrl('principal'));
    }

    public function ganaciasPDFAction(Request $request) {

        $pdfGenerado = $this->get('generarReportePDF')->generarReporteGanciasPDF($request->request->get("filtro"), $request->request->get("txtCorreo"));

        header("Content-Type: application/x-pdf");
        header("Content-Disposition: attachment; filename=Reporte de Reservaciones-" . date("d-m-Y") . ".pdf");
        header("Cache-Control: no-cache, must-revalidate");
        echo $pdfGenerado->render();
        return new Response("Reporte generado con éxito");
    }

}
