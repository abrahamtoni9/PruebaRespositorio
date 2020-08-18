<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <!--=============================================
                 CONTENIDO
	=============================================-->
  <section class="content">
    <div class="row">


      <!--=============================================
                  FORMULARIO DE LA CABECERA
	    =============================================-->
      <div class='col-lg-5 col-xs-12'><!--col-lg-5 para pantalla de escritorio ocupa 5 columna, col-xs-12 para dispositivo movil ocupa las 12 columna, apartir de pantalla movil pequena y media muestra en las 12 col-->
      
        <div class="box box-success"><!--caja superior del formulario con color success-->

          <div class="box-header with-border"><!--caja blanca como un padding de la linea superior-->

            <form method="POST" role="form" class="formularioVenta"> formulario

              <div class = "box-body"><!--caja del cuerpo-->


                <div class="box"><!--Caja de los inputs DE LA CABECERA-->


                  <!--=============================================
                                ENTRADA DEL VENDEDOR
	                =============================================-->  
                  <div class="form-group">
                  
                    <div class = "input-group">
                    
                      <span class="input-group-addon"><!--Icono alado del input-->
                        <i class="fa fa-user"></i>
                      </span>
                      <input type="text" class="form-control input-lg" name="nuevoVendedor" id="nuevoVendedor"  value="<?= $_SESSION['nombre']?>" readonly>

                      <!-- input oculto id del vendedor -->
                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                    </div>

                  </div>


                  <!--=============================================
                                CODIGO DE LA VENTA
	                =============================================-->  
                  <div class="form-group">
                  
                    <div class = "input-group">
                    
                      <span class="input-group-addon"><!--Icono alado del input-->
                        <i class="fa fa-key"></i>
                      </span>


                      <?php

                        $item = null;
                        $valor = null;
                        $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                        if(!$ventas)
                        {
                          echo '<input type="text" class="form-control input-lg" name="nuevaVenta" id="nuevaVenta"  value="234324" readonly>';
                        }
                        else
                        {
                          foreach ($ventas as $key => $value) {
                            
                          }

                          // trae la ultima accion del foreach y capturamos el CODIGO y sumamos , en el select tiene que esta en desc la fecha 
                          $codigo = $value['codigo'] + 1;

                          echo '<input type="text" class="form-control input-lg" name="nuevaVenta" id="nuevaVenta"  value="'.$codigo.'" readonly>';
                        }
                      
                      ?>
                      
                      

                    </div>

                  </div>


                  <!--=============================================
                                ENTRADA DEL CLIENTE
	                =============================================-->  

                  <div class="form-group">
                    
                    <div class = "input-group">
                    
                      <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </span>

                      <select name="seleccionarCliente" id="seleccionarCliente" class="form-control select2" style="width: 95%" required>

                        <option value="">Seleccionar el cliente</option>

                        <?php 
                        
                          $item = null;
                          $valor = null;
                          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                          foreach ($clientes as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';
                          }
                        
                        ?>

                      </select>

                      <!-- Trigger the modal with a button -->
                      <span class="input-group-addon ">
                        <button type="button" class='btn btn-default btn-xs' data-toggle='modal' data-target='#modalAgregarCliente' data-dismiss="modal" >Agregar cliente</button>
                      </span>

                    </div>
                    
                  </div>
                  
                  
                  
                  <!--=============================================
                            ENTRADA PARA AGREGAR PRODUCTO
	                =================================================-->  
                  <div class="form-group row nuevoProducto">


                    <!-- descripcion del producto -->
                    <!-- <div class="col-xs-6" style="padding-right:0px"> -->

                      <!-- <div class="input-group"> -->

                        <!-- boton para eliminar producto -->
                        <!-- <span class="input-group-addon"> -->
                          <!-- <button type="button" class='btn btn-danger btn-xs'><i class="fa fa-times"></i></button> -->
                        <!-- </span> -->

                        <!-- campo para agregar producto -->
                        <!-- <input type="text" class="form-control" name="agregarProducto" id="agregarProducto"  placeholder="Descripcion del producto" required> -->

                      <!-- </div> -->

                    <!-- </div> -->



                    <!-- cantidad del producto -->
                    <!-- <div class="col-xs-3"> -->

                      <!-- campo para modifica la cantidad del producto a vender -->
                      <!-- <input type="number" class="form-control" name="nuevaCantidadProducto" id="nuevaCantidadProducto" min="1"  placeholder="0" required> -->

                    <!-- </div> -->



                    <!-- Precio del producto -->
                    <!-- <div class="col-xs-3" style="padding-left:0px"> -->

                      <!-- <div class="input-group"> -->

                        <!-- <span class="input-group-addon"> -->
                          <!-- <i class="ion ion-social-usd"></i> -->
                        <!-- </span> -->

                        <!-- campo para el nuevo precio del producto -->
                        <!-- <input type="number" min="1" class="form-control" name="nuevoPrecioProducto" id="nuevoPrecioProducto "  placeholder="000000" readonly  required> -->

                      <!-- </div> -->

                    <!-- </div> -->


                  </div">


                  <input type="hidden" id="listaProductos" name="listaProductos">
                  




                  <!--=============================================
                            BOTON PARA AGREGAR PRODUCTO
                  =================================================--> 
                  
                  <!-- hidden-lg indica que en pantalla de escritorio no se van muestrar este boton, solo se va a mostrar en pantalla movil pequena y mediana  -->
                  <button type="button" class='btn btn-default hidden-lg btnAgregarProducto'>Agregar produtos</button>

                  <hr>
                  


                  <!--=============================================
                          ENTRADA IMPUESTO Y TOTAL DE PRODUCTO
                  =================================================--> 
                  <div class="row"><!--nueva fila-->

                    <!-- bloque que ocupa 8 columna hacia la derecha -->
                    <div class="col-xs-8 pull-right">

                      <table class="table"><!--Nueva tabla-->

                        <thead><!--Cabecera de la tabla-->

                          <tr><!--Nueva linea-->
                            <th>Impuesto</th>
                            <th>Total</th>
                          </tr>

                        </thead><!--Fin de la Cabecera de la tabla-->

                        <tbody><!--Cuerpo de la tabla-->

                          <tr><!-- Nueva fila de la tabla-->

                            <td style="width:50%">

                              <div class="input-group">

                                <span class="input-group-addon">
                                  <i class="fa fa-percent"></i>
                                </span>

                                <!-- campo para el porcentaje de impuesto del producto -->
                                <input type="number" min="0" class="form-control input-lg " name="nuevoImpuestoVenta" id="nuevoImpuestoVenta"  placeholder="0" required>

                                <!-- valor del impuesto a recargar el neto -->
                                <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto">
                                 
                                <!-- valor del impuesto a recargar el neto -->
                                <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto">

                              </div>

                            </td>

                            <td style="width:50%">

                              <div class="input-group">

                                <span class="input-group-addon">
                                  <i class="ion ion-social-usd"></i>
                                </span>

                                <!-- campo para el total de venta del producto -->
                                <input type="text" class="form-control input-lg" name="nuevoTotalVenta" id="nuevoTotalVenta" total="" placeholder="000000" readonly required>

                                <!-- input oculto  -->
                                <input type="hidden" name="totalVenta" id="totalVenta">


                              </div>

                            </td>

                          </tr>

                        </tbody><!-- Fin del cuerpo de la tabla-->


                      </table>

                    </div><!-- fin del bloque que ocupa 8 columna-->

                  </div><!-- Fin de nueva fila de la tabla-->

                  <hr>






                  <!--=============================================
                            METODO DE PAGO DEL PRODUCTO
                  =================================================-->

                  <div class="form-group row"><!-- Nueva fila -->

                    <div class="col-xs-6" style="padding-right:0px">

                      <div class="input-group">
                  
                        <select name="nuevoMetodoPago" id="nuevoMetodoPago" class="form-control nuevoMetodoPago">

                          <option value="">Seleccionar metodo de pago</option>
                          <option value="Efectivo">Efectivo</option>
                          <option value="TC">Tarjeta de credito</option>
                          <option value="TD">Tarjeta de debito</option>

                        </select>

                      </div>

                    </div>


                    <!-- en esta caja se va generar en forma dinamica los input deacuerdo al metodo de pago seleccionado -->
                    <div class="  cajasMetodoPago">
                      <!-- <div class="col-xs-6" style="padding-left:0px">

                        <div class="input-group">

                          <input type="text" class="form-control" name="nuevoCodigoTransaccion" id="nuevoCodigoTransaccion"  placeholder="Codigo de transaccion" required>

                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                        </div>

                      </div> -->
                    
                    </div>

                    <input type="hidden" name="listaMetodoPago" id="listaMetodoPago">


                  </div>

                  <hr>

                </div>


              </div><!-- fin de la caja del cuerpo-->
              


              <div class = "box-footer"><!-- caja footer de la cabecera-->

                <button type="submit" class='btn btn-primary pull-right' >Guardar Cambios</button>
              
              </div><!-- fin de la caja footer de la cabecera-->

              

            <?php 
              
              $guardarVenta = new ControladorVentas();
              $guardarVenta -> ctrCrearVenta();

            ?>
            </form>
                          

          </div>

        </div>

      </div>




















      <!--=============================================
                TABLA O DETALLE DE PRODUCTOS
	    =============================================-->
      <div class='col-lg-7 hidden-md hidden-sm hidden-xs'><!--col-lg-7 para pantalla de escritorio ocupa 7 columna, con hidden md, sm y xs se oculta el detalle en pantalla mediana pequena y movil-->
        
        <div class="box box-warning"><!--linea superior del detalle con color warning-->
        
          <div class="box-header with-border"><!--franja blanca como un padding de la linea superior-->

            <div class="box-body">
            
              <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
              
                <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Imagen</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>

                <tbody>

                  

                </tbody>
              
              </table>

            </div>

          </div>

        </div>

      </div>



    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




















<!--=============================================
                 MODAL AGREGAR DE CLIENTES
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarCliente">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- cuando manejamos archivo de subida de imagen usamos enctype="multipart/form-data"  -->
      <form action="" role="form" method="POST"> 
        

        <!--=============================================
                  CABEZA DEL MODAL
        =============================================-->

        <!-- <div class="modal-header"> -->
        <div class="modal-header" style="background:#3c8dbc;color:white">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <!-- <h4 class="modal-title">Default Modal</h4> -->
          <h4 class="modal-title">Agregar cliente</h4>
        </div>


        <!--=============================================
                  CUERPO DEL MODAL
        =============================================-->

        <div class="modal-body">
          
          <div class="box-body">


              <!-- ENTRADA PARA NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCliente"  placeholder="Ingresar nombre" required>
                
              </div>
            </div>


              <!-- ENTRADA PARA ID -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min='0' class="form-control input-lg" name="nuevoDocumentoId"  placeholder="Ingresar documento" required>
                
              </div>
            </div>


              <!-- ENTRADA PARA EMAIl -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="nuevoEmail"  placeholder="Ingresar email" required>
                
              </div>
            </div>


              <!-- ENTRADA PARA TELEFONO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" min='0' class="form-control input-lg" name="nuevoTelefono"  placeholder="Ingresar telefono"  data-inputmask="'mask':'(9999)-999-999'" data-mask required>
                
              </div>
            </div>


              <!-- ENTRADA PARA DIRECCION -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" min='0' class="form-control input-lg" name="nuevaDireccion"  placeholder="Ingresar direccion" required>
                
              </div>
            </div>


              <!-- ENTRADA PARA FECHA DE NACIMIENTO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" min='0' class="form-control input-lg" name="nuevaFechaNacimiento"  placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>
                
              </div>
            </div>

            
            
          </div>
        </div>

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cliente</button>
        </div>


              
         <!--=============================================
                  INSTANCIA PARA AGREGAR
        =============================================-->

        <?php
              
          $crearCliente = new ControladorClientes();
          $crearCliente->ctrCrearClienteDesdeVenta();

        
        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->