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
        $reservaciones = new ArrayCollection();
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
        $pdf = new \ZendPdf\PdfDocument();
        $page = $this->crearPage();
        $page = $this->crearEnacabezado($page);

        $posY = 760;

        foreach ($reservaciones as $reservacion) {
            $totalReservacion = $reservacion->getTotalReservacion() + $reservacion->getSubtotalServicios() + $reservacion->getSubtotalActividades();
            $page->drawText($reservacion->getCodigo(), 50, $posY);
            $page->drawText($reservacion->getHabitacion()->getTipo(), 150, $posY);
            $page->drawText($reservacion->getFechaIngreso()->format('d-m-Y'), 230, $posY);
            $page->drawText($reservacion->getFechaSalida()->format('d-m-Y'), 330, $posY);
            $page->drawText(number_format($reservacion->getCantidadDias(), 0), 430, $posY);
            $page->drawText(number_format($totalReservacion, 2), 510, $posY);
            $posY -= 22.7;
            if ($posY < 70) {
                $posY = 760;
                $pdf->pages[] = $page;
                $page = $this->crearPage();
            }
        }
        $pdf->pages[] = $page;
        $pdf->save(__DIR__ . '\..\Services\documentos\new.pdf');
        return $pdf;
    }

    private function crearPage() {
        $page = new Page(Page::SIZE_A4);
        $style = new \ZendPdf\Style();
        $style->setFont(\ZendPdf\Font::fontWithName(\ZendPdf\Font::FONT_HELVETICA), 12);
        $style->setFontSize(12);
        $page->setFont($style->getFont(), $style->getFontSize());
        return $page;
    }

    private function crearEnacabezado($page) {
        $page->drawText('Codigo', 50, 780);
        $page->drawText('Habitacion', 150, 780);
        $page->drawText('Fecha Ingreso', 230, 780);
        $page->drawText('Fecha Salida', 330, 780);
        $page->drawText('No Dias', 430, 780);
        $page->drawText('Total', 510, 780);
        return $page;
    }

}
