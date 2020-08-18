<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      <!-- colocamos el titulo -->
      Administrar clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <!-- cambiamos el titulo de la esquina derecha -->
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
      
        <!-- Trigger the modal with a button -->
        <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarCliente'>Agregar cliente</button>

      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Documento ID</th>
              <th>Email</th>
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Fecha nacimiento</th>
              <th>Total compras</th>
              <th>Ultima compra</th>
              <th>Ingreso al sistema</th>
              <th>Acciones</th>
            </tr>
          </thead>


          <tbody>


            <?php
              $item = null;
              $valor = null;

              $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);

              // var_dump($categorias);
              // die();
              
              foreach($clientes as $key => $value)
              {
                // var_dump($value['nombre']);

                echo '<tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["documento"].'</td>
                  <td>'.$value["email"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>'.$value["fecha_nacimiento"].'</td>
                  <td>'.$value["compras"].'</td>
                  <td>'.$value["ultima_compra"].'</td>
                  <td>'.$value["fecha"].'</td>
                  <td>
                    <div class="btn-group">

                      <!-- BOTON EDITAR-->
                      <button class="btn btn-warning btnEditarCliente" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>

                      <!--BOTON ELIMINAR-->
                      <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>
                      
                    </div>
                  </td>
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
          $crearCliente->ctrCrearCliente();

        
        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->















<!--=============================================
                 MODAL EDITAR CLIENTE
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalEditarCliente">
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
          <h4 class="modal-title">Editar cliente</h4>
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
                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente"  placeholder="Ingresar nombre" required>

                <!-- input oculto -->
                <input type="hidden" name="idCliente" id="idCliente">
                
              </div>
            </div>


            <!-- ENTRADA PARA ID -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min='0' class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId"  placeholder="Ingresar documento" required>
                
              </div>
            </div>


            <!-- ENTRADA PARA EMAIl -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail"  placeholder="Ingresar email" required>
                
              </div>
            </div>


            <!-- ENTRADA PARA TELEFONO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" min='0' class="form-control input-lg" name="editarTelefono" id="editarTelefono"  placeholder="Ingresar telefono"  data-inputmask="'mask':'(9999)-999-999'" data-mask required>
                
              </div>
            </div>


            <!-- ENTRADA PARA DIRECCION -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" min='0' class="form-control input-lg" name="editarDireccion" id="editarDireccion"  placeholder="Ingresar direccion" required>
                
              </div>
            </div>


            <!-- ENTRADA PARA FECHA DE NACIMIENTO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" min='0' class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento"  placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>
                
              </div>
            </div>

          </div><!--fin box-body-->

        </div><!--fin modal-body-->

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>



              
        <!--=============================================
                  INSTANCIA PARA EDITAR
        =============================================-->

        <?php
        
          $editarCliente = new ControladorClientes();
          $editarCliente -> ctrEditarCliente();
        
        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--=============================================
          INSTANCIA PARA BORRAR
=============================================-->

<?php
         
    $eliminarCliente = new ControladorClientes();
    $eliminarCliente -> ctrEliminarCliente();
        
?>