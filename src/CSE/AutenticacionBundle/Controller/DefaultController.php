<?php

namespace CSE\AutenticacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CSEAutenticacionBundle:Default:index.html.twig', array('name' => $name));
    }
}
