<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      <!-- colocamos el titulo -->
      Administrar ventas 
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <!-- cambiamos el titulo de la esquina derecha -->
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
      
        <!-- Trigger the modal with a button -->
        <a href="crear-venta">
          <button class='btn btn-primary'>Agregar ventas</button>
        </a>

        <button class="btn btn-default pull-right" id="daterange-btn">

          <span>
            <i class="fa fa-calendar"></i> Rango de fecha 
          </span>

          <i class="fa fa-caret-down"></i>
        
        </button>

      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Codigo de factura</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Forma de pago</th>
              <th>Neto</th>
              <th>Total comp.</th>
              <th>Fecha trans.</th>
              <th>Acciones</th>
            </tr>
          </thead>


          <tbody>

            <?php

              // var_dump($_GET['fechaInicial']);
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

              // var_dump($respuesta);
              // var_dump($respuesta["id_cliente"]);
              // var_dump($respuesta["codigo"]);

              foreach ($respuesta as $key => $value) {

                // var_dump($value['id']);
                
                echo '<tr>
                        <td>'.($key+1).'</td>

                        <td>'.$value["codigo"].'</td>';

                        $itemCliente = "id";

                        $valorCliente = $value["id_cliente"];

                        $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                        echo '<td>'.$respuestaCliente['nombre'].'</td>';

                        
                        $itemVendedor = "id";

                        $valorVendedor = $value["id_vendedor"];

                        $respuestaCliente = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

                        echo '<td>'.$respuestaCliente["nombre"].'</td>
                        <td>'.$value["metodo_pago"].'</td>
                        <td>'.number_format($value["neto"],2).'</td>
                        <td>'.number_format($value["total"],2).'</td>
                        <td>'.$value["fecha"].'</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning btnEditarVenta"  idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>
                            <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>
                          </div>
                          </td>
                          </tr>';
                        }
                        
                        
                        ?>
                        <!--<a href="index.php?ruta=editar-venta&idVenta='.$value["id"].'"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>-->

            <!-- <tr>
              <td>1</td>
              <td>23423432</td>
              <td>Juan Villegas</td>
              <td>Julio Gomez</td>
              <td>TC-23423423</td>
              <td>$ 1.000</td>
              <td>$ 1,190.000</td>
              <td>2017-12-11 12:04:23</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-info"><i class="fa fa-print"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr> -->

          </tbody>

        </table>

        
      <?php 


        $eliminarVenta = new ControladorVentas();

        $eliminarVenta -> ctrEliminarVenta();

      ?>

      </div>
      
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->







