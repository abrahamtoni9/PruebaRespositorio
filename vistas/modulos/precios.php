<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Consulta de precios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Consulta de precios</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaPrecios tabla" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Precio minorista</th>
              <th>Precio mayorista</th>
              <!-- <th>Acciones</th> -->
            </tr>
          </thead>

          <tbody>

            <?php
                $item = null;
                $valor = null;

                $productos = ControladorProductos::ctrMostrarPrecios($item,$valor);

                //  var_dump($productos);
                
                foreach($productos as $key => $value)
                {
                  // var_dump($value['nombre']);


                   

                  echo '
                  <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["codigo"].'</td>
                    <td>'.$value["descripcion"].'</td>
                    <td>'.number_format($value["minoristaxunidad"]).'</td>
                    <td>'.number_format($value["mayoristaxunidad"]).'</td>
                  </tr>';

                }
            ?>

          
          </tbody>
          


        </table>

      </div>
      
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->












