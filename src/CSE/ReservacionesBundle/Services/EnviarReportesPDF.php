<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnviarReportesPDF
 *
 * @author gvasquez
 */
class EnviarReportesPDF {

    private $doctrine;
    private $email;

    public function __construct($serviceDoctrine, $servicesEmail) {
        $this->doctrine = $serviceDoctrine;
        $this->email = $servicesEmail;
    }

    public function enviarReportePDF($correo) {
        $mensaje = new \Swift_Message();
        $mensaje->setContentType('text/html')
                ->setSubject('Reservación código:' . $entity->getCodigo())
                ->setFrom('HotelBrisasdelPacifico@gmail.com')
                ->setTo($correo)
                ->setBody("Cuerpo del mensaje")
                ->attach(Swift_Attachment::fromPath(__DIR__ . '/../Services/documentos/new.pdf'));
        $this->email->send($mensaje);

//        __DIR__ . '/../Services/documentos/new.pdf'
    }

}
