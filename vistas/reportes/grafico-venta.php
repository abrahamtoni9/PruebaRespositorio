
<?php
    // var_dump($_GET['fechaInicial']);
    // if(isset($_GET['fechaInicial']))
    // {

        // var_dump($_GET['fechaFinal']);

        if(isset($_GET["fechaInicial"]))
        {
            $fechaFinal = $_GET['fechaFinal'];
            $fechaInicial = $_GET['fechaInicial'];
        }
        else
        {
            $fechaFinal = null;
            $fechaInicial = null;
        
        }
        
        // $item = null;
        // $valor = null;

        // $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
        $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

        foreach ($respuesta as $key => $value) {
            
            // var_dump($value);

        }
    // }


    ?>

    <div class="box box-solid bg-teal-gradient">

        <div class="box-header">

            <i class="fa fa-th">

                <h3 class="box-title">Grafico de ventas</h3>

            </i>

        </div>

        <div class="box-body border-radius-none nuevoGraficoVentas">
        
            <div class="chart" id="line-chart-ventas" style="height:250px"></div>
        
        </div>

    </div>


<script>

    var line = new Morris.Line({
        element          : 'line-chart-ventas',
        resize           : true,
        data             : [
        { y: '2015', ventas: 2666 },
        { y: '2016', ventas: 2778 },
        { y: '2017', ventas: 4912 },
        { y: '2018', ventas: 3767 },
        { y: '2019 ', ventas: 6810 }
        ],
        xkey             : 'y',
        ykeys            : ['ventas'],
        labels           : ['ventas'],
        lineColors       : ['#efefef'],
        lineWidth        : 2,
        hideHover        : 'auto',
        gridTextColor    : '#fff',
        gridStrokeWidth  : 0.4,
        pointSize        : 4,
        pointStrokeColors: ['#efefef'],
        gridLineColor    : '#efefef',
        gridTextFamily   : 'Open Sans',
        gridTextSize     : 10
    });

</script>