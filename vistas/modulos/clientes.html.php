<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      <!-- colocamos el titulo -->
      Administrar clinetes
    
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


            <tr>
              <td>1</td>
              <td>Juan Villega</td>
              <td>12423423</td>
              <td>edsonsalo@hotmail.com</td>
              <td>1232 - 323 - 234</td>
              <td>calle 12 # 40 - 43</td>
              <td>1213-234-11</td>
              <td>2017-12-11 12:04:23</td>
              <td>35</td>
              <td>2017-12-11 12:04:23</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>

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
                 MODAL AGREGAR DE CLIENTE
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
                <input type="number" min='0' class="form-control input-lg" name="nuevoDocumento"  placeholder="Ingresar documento" required>
                
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
              
          $crearCategoria = new ControladorCategorias();
          $crearCategoria->ctrCrearCategoria();

        
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
          <h4 class="modal-title">Editar Categoria</h4>
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
                <input type="number" min='0' class="form-control input-lg" name="nuevoDocumento"  placeholder="Ingresar documento" required>
                
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
        
          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();
        
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
         
    $borrarCategoria = new ControladorCategorias();
    $borrarCategoria -> ctrBorrarCategoria();
        
?>