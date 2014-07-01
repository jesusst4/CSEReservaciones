<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnviarReservacipnServices
 *
 * @author gvasquez
 */

namespace CSE\ReservacionesBundle\Services;

class EnviarReservacionServices {

    private $doctrine;
    private $email;

    public function __construct($serviceDoctine, $serviceEmail) {
        $this->doctrine = $serviceDoctine;
        $this->email = $serviceEmail;
    }

    public function enviarReservacion($id) {
        $em = $this->doctrine->getManager();

        $entity = $em->getRepository('CSEReservacionesBundle:Reservacion')->find($id);
        $servicios = $em->getRepository('CSEReservacionesBundle:ServiciosXReservacion')->serviciosXReservacion($id);
        $actividades = $em->getRepository('CSEReservacionesBundle:AtividadesXReservacion')->actividadesXReservacion($id);

        $tablaServicios = "";
        $tablaActividades = "";
        $total=$entity->getTotalReservacion() + $entity->getSubtotalServicios() +$entity->getSubtotalActividades();

        foreach ($servicios as $servicio) {
            $tablaServicios .= "<tr>
                            <td>" . $servicio->getServicio()->getTipo() . "</td>";
            if ($servicio->getCantPersonas() == null) {
            } else {
                $tablaServicios.= "<td>" . $servicio->getCantPersonas() . " Personas</td>";
            }
            $tablaServicios.="</tr>";
        }

        foreach ($actividades as $actividad) {
            $tablaActividades .= "<tr><td>" . $actividad->getActividad()->getTipo() . "</td>";
            $tablaActividades.= "<td>" . $actividad->getCantPersonas() . " Personas</td>";
             $tablaActividades.= "<td>" .$actividad->getFecha()->format('d-m-Y') . "</td>";
            $tablaActividades.="</tr>";
        }
        $mensaje = new \Swift_Message();
        $mensaje->setContentType('text/html')
                ->setSubject('Reservación código:')
                ->setFrom('HotelBrisasdelPacifico@gmail.com')
                ->setTo($entity->getHuesped()->getCorreo())
                ->setBody("<html>
                <head>
                     <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                     <title>Reservación</title>
                </head>
                <body>
                     <table>
                        <thead>
                            <tr>
                                 <th>Datos Personales</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>Código Reservación</td>
                                <td>" . $entity->getCodigo() . "</td>
                         </tr>
          
                         <tr>
                            <td>Nombre</td>
                            <td>" . $entity->getHuesped()->getNombre() . "</td>
                         </tr>
            
                         <tr>
                            <td>Cédula</td>
                            <td>" . $entity->getHuesped()->getCedula() . "</td>
                         </tr>
                          <tr>
                            <td>Email</td>
                            <td>" . $entity->getHuesped()->getCorreo() . "</td>
                         </tr>
                          <tr>
                            <td>Teléfono</td>
                            <td>" . $entity->getHuesped()->getCelular() . "</td>
                         </tr>
                         <thead>
                            <tr>
                                <th>Datos de reservación</th>
                            </tr>
                         </thead>
                         
                         <tr>
                            <td>Tipo Habitación</td>
                            <td>" . $entity->getHabitacion()->getTipo() . "</td>
                         </tr>
                         <tr>
                            <td>Personas en la reservación</td>
                            <td>" . $entity->getCantPersonas() . "</td>
                         </tr>
                         <tr>
                            <td>Fecha Ingreso</td>
                            <td>" . $entity->getFechaIngreso()->format('d-m-Y') . "</td>
                         </tr>
                         <tr>
                            <td>Fecha Salida</td>
                            <td>" . $entity->getFechaSalida()->format('d-m-Y') . "</td>
                         </tr>
                         <tr>
                            <td>Días reservados</td>
                            <td>" . $entity->getCantidadDias() . "</td>
                         </tr>
                         
                         <thead>
                            <tr>
                                <th>Servicios seleccionados</th>
                            </tr>
                         </thead>" . $tablaServicios . "
                         <thead>
                            <tr>
                                <th>Actividades seleccionadas</th>
                            </tr>
                         </thead>".$tablaActividades." 
                         <thead>
                            <tr>
                                <th>Subtotales</th>
                            </tr>
                         </thead>
                         <tr>
                            <td>Total a pagar por reservación de la habitación</td>
                            <td> $" . $entity->getTotalReservacion() . "</td>
                         </tr>
                         <tr>
                            <td>Total a pagar por reservación de servicios</td>
                            <td> $" . $entity->getSubtotalServicios() . "</td>
                         </tr>
                         <tr>
                            <td>Total a pagar por reservación de actividades</td>
                            <td> $" . $entity->getSubtotalActividades() . "</td>
                         </tr>
                          <thead>
                            <tr>
                                <th>TOTAL A PAGAR</th>
                                <td> $".$total."</td>
                            </tr>
                         </thead>
                         "
                         );
        $this->email->send($mensaje);
    }

}
