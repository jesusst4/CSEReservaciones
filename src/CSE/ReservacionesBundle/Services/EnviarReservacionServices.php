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

use Doctrine\Common\Collections\ArrayCollection;

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
        $total = $entity->getTotalReservacion() + $entity->getSubtotalServicios() + $entity->getSubtotalActividades();

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
            $tablaActividades.= "<td>" . $actividad->getFecha()->format('d-m-Y') . "</td>";
            $tablaActividades.="</tr>";
        }
        $mensaje = new \Swift_Message();
        $mensaje->setContentType('text/html')
                ->setSubject('Reservación código:'.$entity->getCodigo())
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
                         </thead>" . $tablaActividades . " 
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
                                <td> $" . $total . "</td>
                            </tr>
                         </thead>                         
                    </table>
                </body>
            </html>
                         "
        );
        $this->email->send($mensaje);
    }

    public function enviarReporteReservaciones($filtro, $correo) {
        $em = $this->doctrine->getManager();
        $reservaciones=new ArrayCollection();
        $totalRe="";
        if ($filtro == 0) {
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
        }
        else{
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($filtro);
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($filtro);
            $total1 = $total[0];
            $totalRe = $total1['total'];
        }

        $cuerpoTabla="";
        
        foreach ($reservaciones as $reservacion) {
            $totalReservacion=$reservacion->getTotalReservacion() + $reservacion->getSubtotalServicios() + $reservacion->getSubtotalActividades();
            $cuerpoTabla .= "<tr>
                        <td>". $reservacion->getCodigo() ."</td>
                        <td>". $reservacion->getHabitacion()->getTipo() ."</td>
                        <td>". $reservacion->getFechaIngreso()->format('d-m-Y')."</td>
                        <td>". $reservacion->getFechaSalida()->format('d-m-Y')."</td>
                        <td>".  $reservacion->getCantidadDias() ."</td>
                        <td>". $totalReservacion ."</td>
                    </tr>";
        }
        $mensaje = new \Swift_Message();
        $mensaje->setContentType('text/html')
                ->setSubject('Reporte de Reservaciones')
                ->setFrom('HotelBrisasdelPacifico@gmail.com')
                ->setTo($correo)
                ->setBody("<html>
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                        <title>Reservación</title>
                    </head>
                    <body>
                        <table>
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Tipo Habitación</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Fecha Salida</th>
                                    <th>Días Reservados</th>
                                    <th>Total Reservacion</th>

                                </tr>
                            </thead>
                            <tbody>".$cuerpoTabla ."
                               
                            </tbody>
                             <thead>
                              <tr>
                                    <td><h2>Total</h2></td><td><h2>".$totalRe."</h2></td>
                                </tr>
                             </thead>
                        </table>
                    </body>
                 </html>");
        $this->email->send($mensaje);
    }
    
    
     public function enviarReporteGanancias($filtro, $correo) {
        $em = $this->doctrine->getManager();
        $reservaciones=new ArrayCollection();
        $totalRe="";
        if ($filtro == 0) {
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
        }
        else{
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($filtro);
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($filtro);
            $total1 = $total[0];
            $totalRe = $total1['total'];
        }

        $cuerpoTabla="";
        
        foreach ($reservaciones as $reservacion) {
            $totalReservacion=$reservacion->getTotalReservacion() + $reservacion->getSubtotalServicios() + $reservacion->getSubtotalActividades();
            $cuerpoTabla .= "<tr>
                        <td>". $reservacion->getCodigo() ."</td>
                        <td>". $reservacion->getTotalReservacion() ."</td>
                        <td>". $reservacion->getSubtotalServicios()."</td>
                        <td>". $reservacion->getSubtotalActividades()."</td>
                        <td>". $totalReservacion ."</td>
                    </tr>";
        }
        $mensaje = new \Swift_Message();
        $mensaje->setContentType('text/html')
                ->setSubject('Reporte de Ganancias')
                ->setFrom('HotelBrisasdelPacifico@gmail.com')
                ->setTo($correo)
                ->setBody("<html>
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                        <title>Reservación</title>
                    </head>
                    <body>
                        <table>
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Total habitación</th>
                                    <th>Total Servicios</th>
                                    <th>Total actividades</th>
                                    <th>Total Reservacion</th>

                                </tr>
                            </thead>
                            <tbody>".$cuerpoTabla ."
                               
                            </tbody>
                             <thead>
                              <tr>
                                    <td><h2>Total</h2></td><td><h2>".$totalRe."</h2></td>
                                </tr>
                             </thead>
                        </table>
                    </body>
                 </html>");
        $this->email->send($mensaje);
     }
     

}
