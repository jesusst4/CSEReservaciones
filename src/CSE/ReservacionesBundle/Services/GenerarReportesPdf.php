<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenerarReportesPdf
 *
 * @author gvasquez
 */

namespace CSE\ReservacionesBundle\Services;

use Doctrine\Common\Collections\ArrayCollection;
use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;
use ZendPdf\Style;

class GenerarReportesPdf {

    private $doctrine;

    public function __construct($serviceDoctine) {
        $this->doctrine = $serviceDoctine;
    }

    public function generarReporteGanciasPDF($filtro) {

        $em = $this->doctrine->getManager();
        $fecha = date("d-m-Y");
        $reservaciones = new ArrayCollection();
        $pageList = new ArrayCollection();
        $totalRe = "";
        if ($filtro == 0) {
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReservaciones();
            $total1 = $total[0];
            $totalRe = $total1['total'];
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->findAll();
        } else {
            $reservaciones = $em->getRepository('CSEReservacionesBundle:Reservacion')->reporteReservaciones($filtro);
            $total = $em->getRepository('CSEReservacionesBundle:Reservacion')->totalReporte($filtro);
            $total1 = $total[0];
            $totalRe = $total1['total'];
        }
        $pdf = new \ZendPdf\PdfDocument(__DIR__ . '\documentos\plantilla.pdf', NULL, TRUE);
        $page = $pdf->pages[0];

        $style = $this->estilo();
        $page->setFont($style->getFont(), $style->getFontSize());
        $page->drawText($fecha, 490, 725);
        $posY = 640;

        foreach ($reservaciones as $reservacion) {
            $totalReservacion = $reservacion->getTotalReservacion() + $reservacion->getSubtotalServicios() + $reservacion->getSubtotalActividades();
            $page->drawText($reservacion->getCodigo(), 55, $posY);
            $page->drawText($reservacion->getHabitacion()->getTipo(), 150, $posY);
            $page->drawText($reservacion->getFechaIngreso()->format('d-m-Y'), 230, $posY);
            $page->drawText($reservacion->getFechaSalida()->format('d-m-Y'), 330, $posY);
            $page->drawText(number_format($reservacion->getCantidadDias(), 0), 430, $posY);
            $page->drawText(number_format($totalReservacion, 2), 490, $posY);
            $posY -= 22.7;

            if ($posY < 70) {
                $posY = 640;
                $pageList[] = $page;

                $nuevoPDF = new \ZendPdf\PdfDocument(__DIR__ . '\documentos\plantilla.pdf', NULL, TRUE);
                $extractor = new \ZendPdf\Resource\Extractor();
                $page = $extractor->clonePage($nuevoPDF->pages[0]);

                $style = $this->estilo();
                $page->setFont($style->getFont(), $style->getFontSize());
                $page->drawText($fecha, 490, 725);
            }
        }
        $pageList[] = $page;
        for ($i = 0; $i < $pageList->count(); $i++) {
            $pdf->pages[$i] = $pageList[$i];
        }
        $pdf->save(__DIR__ . '\documentos\doc.pdf');
        return $pdf;
    }

    private function estilo() {
        $style = new \ZendPdf\Style();
        $style->setFont(\ZendPdf\Font::fontWithName(\ZendPdf\Font::FONT_HELVETICA), 12);
        $style->setFontSize(12);
        return $style;
    }

}
