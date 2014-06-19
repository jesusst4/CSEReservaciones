<?php

namespace CSE\ReservacionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CSEReservacionesBundle:Default:index.html.twig', array('name' => $name));
    }
}
