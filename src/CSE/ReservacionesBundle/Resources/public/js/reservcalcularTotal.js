/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#calTotal').click(function() {

        var fechaEntrada = document.getElementById('cse_reservacionesbundle_reservacion_fechaIngreso').value;
        var fechaSalida = document.getElementById('cse_reservacionesbundle_reservacion_fechaSalida').value;
        var selectVal = $('#cse_reservacionesbundle_reservacion_habitacion :selected').val();
        var listaHabitaciones;
        listaHabitaciones = $('#habitaciones').val();
        var preciosHabitaciones = JSON.parse(listaHabitaciones, function(clave, valor) {
            return valor;
        });
        //  Se le da vuelta a la variable fechaEntrada para poder convertirla a fecha
        var arrayFechaEntrada = fechaEntrada.split("-");
        var nuevaFechaEntrada = arrayFechaEntrada[1] + '/' + arrayFechaEntrada[0] + '/' + arrayFechaEntrada[2];
        var fechaE = new Date(nuevaFechaEntrada);
        // Se le da vuelta a la variable fechaSalida para poder convertirla a fecha
        var arrayFechaSalida = fechaSalida.split("-");
        var nuevaFechaSalida = arrayFechaSalida[1] + '/' + arrayFechaSalida[0] + '/' + arrayFechaSalida[2];
        var fechaS = new Date(nuevaFechaSalida);

        var restaFechas = fechaS - fechaE;
        restaFechas = (((restaFechas / 1000) / 60) / 60) / 24;


        for (var index = 0; preciosHabitaciones.length; index++) {
            if (selectVal == preciosHabitaciones[index].id) {
                alert(restaFechas);
                if (restaFechas) {
                    var total = restaFechas * preciosHabitaciones[index].precio;
                    document.getElementById("cse_reservacionesbundle_reservacion_totalReservacion").value = total;
                    document.getElementById("cse_reservacionesbundle_reservacion_cantidadDias").value = restaFechas;
                }

            }
        }
    });

    $("#calTotalServ").click(function() {
        $(".limensaje").text("");

        var btnActividades = document.getElementById('actividades');
        btnActividades.disabled = false;
        
        var listaServicios = $('#precioServicios').val();
        var preciosServicios = JSON.parse(listaServicios, function(clave, valor) {
            return valor;
        });

        var total = 0;
        $("#tblServicios tbody tr").each(function(index) {
            var campo1;
            $(this).children("td").each(function(index2) {
                switch (index2) {
                    case 0:
                        if ($(this).find('input')[0].checked == true) {

                            for (var i = 0; i < preciosServicios.length; i++) {

                                if ($(this).find('input')[0].value == preciosServicios[i].id) {

                                    if (preciosServicios[i].requiereCant == 1) {

                                        if ($(this).next().next().next().find('input')[0].value) {
                                            alert($(this).next().next().next().find('input')[0].value);
                                            var subTotal = preciosServicios[i].precio * parseInt($(this).next().next().next().find('input')[0].value);
                                            total += subTotal;
                                        }
                                        else {
                                            $("#errorCatidadPer" + preciosServicios[i].id).text("Ingrese la cantidad de personas y vuelva a calcular el total");
                                            var btnActividades = document.getElementById('actividades');
                                            btnActividades.disabled = true;

                                        }
                                    } else {
                                        total += parseInt(preciosServicios[i].precio);
                                    }
                                }
                            }
                        }
                        campo1 = $(this).text();
                        break;
                }
            })
        })
        document.getElementById("totalServicios").value = total;

    });
});

