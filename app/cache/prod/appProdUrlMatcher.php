<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // cse_reservaciones_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'cse_reservaciones_homepage')), array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/reservacion')) {
            // reservacion
            if (rtrim($pathinfo, '/') === '/reservacion') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'reservacion');
                }

                return array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::indexAction',  '_route' => 'reservacion',);
            }

            // reservacion_show
            if (preg_match('#^/reservacion/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'reservacion_show')), array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::showAction',));
            }

            // reservacion_new
            if ($pathinfo === '/reservacion/new') {
                return array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::newAction',  '_route' => 'reservacion_new',);
            }

            // reservacion_create
            if ($pathinfo === '/reservacion/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_reservacion_create;
                }

                return array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::createAction',  '_route' => 'reservacion_create',);
            }
            not_reservacion_create:

            // reservacion_edit
            if (preg_match('#^/reservacion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'reservacion_edit')), array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::editAction',));
            }

            // reservacion_update
            if (preg_match('#^/reservacion/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_reservacion_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'reservacion_update')), array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::updateAction',));
            }
            not_reservacion_update:

            // reservacion_delete
            if (preg_match('#^/reservacion/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_reservacion_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'reservacion_delete')), array (  '_controller' => 'CSE\\ReservacionesBundle\\Controller\\ReservacionController::deleteAction',));
            }
            not_reservacion_delete:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
