<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      <!-- colocamos el titulo -->
      Administrar usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <!-- cambiamos el titulo de la esquina derecha -->
      <li class="active">Administrar usuarios</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
      
        <!-- Trigger the modal with a button -->
        <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarUsuario'>Agregar usuario</button>

      </div>
      <div class="box-body">
        
        <table class="table table-bordered table-striped tab">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>


          <tbody>


            <tr>
              <td>1</td>
              <td>Usuario Administrar</td>
              <td>Admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="40px" alt=""></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>


            <tr>
              <td>2</td>
              <td>Usuario Administrar</td>
              <td>Admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" alt=""></td>
              <td>Administrador</td>
              <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
              <td>2017-12-11 12:05:32</td>
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
                 MODAL DE USUARIO
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- cuando manejamos archivo de subida de imagen usamos enctype="multipart/form-data"  -->
      <form action="" role="form" method="POST" enctype="multipart/form-data"> 
        

        <!--=============================================
                  CABEZA DEL MODAL
        =============================================-->

        <!-- <div class="modal-header"> -->
        <div class="modal-header" style="background:#3c8dbc;color:white">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <!-- <h4 class="modal-title">Default Modal</h4> -->
          <h4 class="modal-title">Agregar Usuario</h4>
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
                <input type="text" class="form-control input-lg" name="nuevoNombre" id="" placeholder="Ingresar nombre" required>
                
              </div>
              
            </div>


            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PASS -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoPassword" id="" placeholder="Ingresar pass" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL PERFIL -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoPerfil" class="form-control input-lg" id="">

                  <option value="">Seleccionar el perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR LA FOTO -->
            <div class="form-group">
              
              <div class='panel'>Subir foto</div>
              <input type="file" id="nuevafoto" name="nuevaFoto">

              <p class="help-block">Peso maximo de la foto 200 MB</p>

              <!-- foto por defecto -->
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px" alt="">

            </div>

          </div>
        </div>

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->