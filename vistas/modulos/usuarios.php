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

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

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

            <?php
              $item = null;
              $valor = null;

              $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);

              //  var_dump($usuarios);
              
              foreach($usuarios as $key => $value)
              {
                // var_dump($value['nombre']);

                echo '<tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>';
                  if($value["foto"] != "")
                  {
                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px" alt=""></td>';
                  }
                  else
                  {
                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" alt=""></td>';
                  }
                  
                  echo '<td>'.$value["perfil"].'</td>';

                  // si esta activado el usuario
                  if($value['estado'] != 0)
                  {
                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario= "'.$value['id'].'" estadoUsuario = "0">Activado</button></td>';
                  }
                  else
                  {
                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario= "'.$value['id'].'" estadoUsuario = "1">Desactivado</button></td>';

                  }              

                  echo '<td>'.$value["ultimo_login"].'</td>
                  <td>
                    <div class="btn-group">

                      <!-- BOTON EDITAR-->
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <!--BOTON ELIMINAR-->
                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'"  fotoUsuario="'.$value["foto"].'"  usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>
                      
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
                 MODAL AGREGAR DE USUARIO
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
                <input type="text" class="form-control input-lg" name="nuevoNombre"  placeholder="Ingresar nombre" required>
                
              </div>
              
            </div>


            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" id = "nuevoUsuario" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PASS -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword"  placeholder="Ingresar pass" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL PERFIL -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoPerfil" class="form-control input-lg" >

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
              <!-- <input type="file"  id="nuevafoto" name="nuevaFoto"> -->
              <input type="file" class="nuevaFoto"  name="nuevaFoto">

              <p class="help-block">Peso maximo de la foto 2 MB</p>

              <!-- foto por defecto -->
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px" alt="">

            </div>

          </div>
        </div>

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>


        <?php
        
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario->ctrCrearUsuario();
          // $crearUsuario::ctrCrearUsuario();
        
        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->











<!--=============================================
                 MODAL EDITAR USUARIO
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalEditarUsuario">
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
          <h4 class="modal-title">Editar Usuario</h4>
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
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
                
              </div>
              
            </div>


            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL PASS -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword"  placeholder="Ingrese nueva contrasena">

                <!-- pass oculto -->
                <input type="hidden"  id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL PERFIL -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="editarPerfil" class="form-control input-lg" >

                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR LA FOTO -->
            <div class="form-group">
              
              <div class='panel'>Subir foto</div>
              <!-- <input type="file"  id="nuevafoto" name="nuevaFoto"> -->
              <input type="file" class="nuevaFoto"  name="editarFoto">

              <p class="help-block">Peso maximo de la foto 2 MB</p>

              <!-- foto por defecto -->
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px" alt="">

              <!-- CAMPO OCULTO PARA RECUPERAR LA FOTO ACTUAL -->
              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>
        </div>

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>


        <?php
        
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario->ctrEditarUsuario();
        
        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->







<?php

// Instanciamos la clase ControladorUsuarios
$borrarUsuario = new ControladorUsuarios();

// llamamos al metodo ctrBorrarUsuario, este se dispara en todo momento y entra en la funcion ctrBorrarUsuario y si cumple con la condicion if(isset($_GET['idUsuario'])) lo ejecuta
$borrarUsuario -> ctrBorrarUsuario();


?>