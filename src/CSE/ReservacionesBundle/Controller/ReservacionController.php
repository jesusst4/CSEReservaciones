<?php

namespace CSE\ReservacionesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CSE\ReservacionesBundle\Entity\Reservacion;
use CSE\ReservacionesBundle\Form\ReservacionType;

use CSE\ReservacionesBundle\Entity\Huesped;
use CSE\ReservacionesBundle\Form\HuespedType;

/**
 * Reservacion controller.
 *
 */
class ReservacionController extends Controller
{

    /**
     * Lists all Reservacion entities.
     *
     */
    public function indexAction()
    {
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
    public function createAction(Request $request)
    {
        $entity = new Reservacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reservacion_show', array('id' => $entity->getId())));
        }

        return $this->render('CSEReservacionesBundle:Reservacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Reservacion entity.
    *
    * @param Reservacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Reservacion $entity)
    {
        $form = $this->createForm(new ReservacionType(), $entity, array(
            'action' => $this->generateUrl('reservacion_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Reservacion entity.
     *
     */
    public function newAction()
    {
        $entity = new Reservacion();
        $entity->setCodigo("B012F456T7");
        $form   = $this->createCreateForm($entity);
        $huesped= new Huesped();
        $formHuesped= $this->createCreateFormHuesped($huesped);

        return $this->render('CSEReservacionesBundle:Reservacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'formHuesped'   => $formHuesped->createView(),
        ));
    }

    /**
     * Finds and displays a Reservacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CSEReservacionesBundle:Reservacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Reservacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CSEReservacionesBundle:Reservacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
    private function createEditForm(Reservacion $entity)
    {
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
    public function updateAction(Request $request, $id)
    {
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
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Reservacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
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
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    
    /**
    * Creates a form to create a Huesped entity.
    *
    * @param Huesped $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateFormHuesped(Huesped $entity)
    {
        $form = $this->createForm(new HuespedType(), $entity, array(
            'action' => $this->generateUrl('huesped_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

   
}
