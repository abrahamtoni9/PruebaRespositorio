
/*=============================================
            VARIABLE LOCALSTORAGE 
=============================================*/

if(localStorage.getItem("capturarRango2") != null)
{
    $("#daterange-btn2 span").html(localStorage.getItem("capturarRango"));
}
else
{
    $("#daterange-btn2 span").html("<i class='fa fa-calendar'></i>Rango de fecha");
}




/*==========================================================
                RANGO DE FECHAS
============================================================*/
 
//Date range as a button
$('#daterange-btn2').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Ultimos 7 dias' : [moment().subtract(6, 'days'), moment()],
        'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Ultimo mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
    //   startDate: moment().subtract(29, 'days'),
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {
        $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        
        var fechaInicial = start.format('YYYY-MM-DD');
        console.log("fechaInicial", fechaInicial);
        
        var fechaFinal = end.format('YYYY-MM-DD');
        console.log("fechaFinal", fechaFinal);

        var capturarRango = $("#daterange-btn2 span").html();
        console.log("capturarRango2 : ", capturarRango);

        localStorage.setItem("capturarRango2", capturarRango);

        window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    }
  )








    /*==========================================================
                CANCELAR RANGO DE FECHAS
    ============================================================*/

    $(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function()
    {
        localStorage.removeItem("capturarRango2");
        localStorage.clear();
        window.location = "reportes";
    })







    /*==========================================================
                        CAPTURAR HOY
    ============================================================*/

    $(".daterangepicker.opensright .ranges li").on("click", function()
    {
        // console.log($(this).attr("data-range-key"));

        var textoHoy = $(this).attr("data-range-key");

        if(textoHoy == "Hoy")
        {
            var d = new Date();
            console.log("fecha hoy : ", d);
            
            var dia = d.getDate();
            console.log("dia de hoy : ", dia);
            var mes = d.getMonth()+1;//en javascript es de 0 a 11, por eso sumamos a 1
            var anio = d.getFullYear();

            // si el mes es menor a 10 vamos a concatenar un 0 delante del nro del mes
            if(mes < 10)
            {
                var fechaInicial = anio+"-0"+mes+"-"+dia;
                var fechaFinal = anio+"-0"+mes+"-"+  dia;
            }
            else if( dia < 10 )
            {
                var fechaInicial = anio+"-"+mes+"-0"+dia;
                var fechaFinal = anio+"-"+mes+"-0"+dia;
            }
            else if( mes < 10 && dia < 10 )
            {
                var fechaInicial = anio+"-0"+mes+"-0"+dia;
                var fechaFinal = anio+"-0"+mes+"-0"+dia;
            }
            else
            {
                var fechaInicial = anio+"-"+mes+"-"+dia;
                var fechaFinal = anio+"-"+mes+"-"+  dia;
            }


            localStorage.setItem("capturarRango2", "Hoy");

            window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;


        }
    })



















