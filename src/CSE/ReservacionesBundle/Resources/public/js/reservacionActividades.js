/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {

    $('#calTotalA').click(function() {
        var listaActividadesCod = $('#actividades').val();
        var listaActividadesDec = JSON.parse(listaActividadesCod, function(clave, valor) {
            return valor;
        });

        $(".limensaje").text("");

        var total = 0;
        $("#tblActividades tbody tr").each(function(index) {
            var campo1, campo2, campo3;
            $(this).children("td").each(function(index2) {
                switch (index2) {
                    case 0:
                        if ($(this).find('input')[0].checked == true) {
                            if ($(this).next().next().next().next().find('input')[0].value) {
                                for (var a = 0; a < listaActividadesDec.length; a++) {
                                    if ($(this).find('input')[0].value == listaActividadesDec[a].id) {
                                        prueba = ($(this).next().next().next().next().find('input')[0].value * listaActividadesDec[a].precio);
                                        total += prueba;
                                    }
                                }
                            }
                            else {
                                $("#errorCatidadPer" + $(this).find('input')[0].value).text("Ingrese la cantidad de personas");
                            }
                        }
                        campo1 = $(this).text();
                        break;
                }
            })
        })
        document.getElementById("txtTotalActividades").value = total;
    })
});


