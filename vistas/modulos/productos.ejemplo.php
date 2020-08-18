<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      <!-- colocamos el titulo -->
      Administrar producto
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <!-- cambiamos el titulo de la esquina derecha -->
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
      
        <!-- Trigger the modal with a button -->
        <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarProducto'>Agregar producto</button>

      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tab" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Categoria</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Fecha agregado</th>
              <th>Acciones</th>
            </tr>
          </thead>


          <tbody> 

            <tr>
              <td>1</td>
              <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="40px" alt=""></td>
              <td>001</td>
              <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis dicta facere modi blanditiis tempore? Facere nemo id nam, excepturi error ex quidem in. Obcaecati corporis sed fugiat officia, molestias quisquam.</td>
              <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et porro eaque dolor odit aliquid necessitatibus vero obcaecati placeat nulla maxime aspernatur veritatis cumque numquam ex doloribus, libero, sapiente exercitationem quis!</td>
              <td>20</td>
              <td>5.000 grs</td>
              <td>10.000 grs</td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>




            <tr>
              <td>1</td>
              <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="40px" alt=""></td>
              <td>001</td>
              <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis dicta facere modi blanditiis tempore? Facere nemo id nam, excepturi error ex quidem in. Obcaecati corporis sed fugiat officia, molestias quisquam.</td>
              <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et porro eaque dolor odit aliquid necessitatibus vero obcaecati placeat nulla maxime aspernatur veritatis cumque numquam ex doloribus, libero, sapiente exercitationem quis!</td>
              <td>20</td>
              <td>5.000 grs</td>
              <td>10.000 grs</td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>



            <tr>
              <td>1</td>
              <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="40px" alt=""></td>
              <td>001</td>
              <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis dicta facere modi blanditiis tempore? Facere nemo id nam, excepturi error ex quidem in. Obcaecati corporis sed fugiat officia, molestias quisquam.</td>
              <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et porro eaque dolor odit aliquid necessitatibus vero obcaecati placeat nulla maxime aspernatur veritatis cumque numquam ex doloribus, libero, sapiente exercitationem quis!</td>
              <td>20</td>
              <td>5.000 grs</td>
              <td>10.000 grs</td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>




            <tr>
              <td>1</td>
              <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="40px" alt=""></td>
              <td>001</td>
              <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis dicta facere modi blanditiis tempore? Facere nemo id nam, excepturi error ex quidem in. Obcaecati corporis sed fugiat officia, molestias quisquam.</td>
              <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et porro eaque dolor odit aliquid necessitatibus vero obcaecati placeat nulla maxime aspernatur veritatis cumque numquam ex doloribus, libero, sapiente exercitationem quis!</td>
              <td>20</td>
              <td>5.000 grs</td>
              <td>10.000 grs</td>
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
                 MODAL AGREGAR DE PRODUCTO
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarProducto">
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
          <h4 class="modal-title">Agregar Producto</h4>
        </div>


        <!--=============================================
                  CUERPO DEL MODAL
        =============================================-->

        <div class="modal-body">
          
          <div class="box-body">


            <!-- ENTRADA PARA EL CODIGO -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCodigo" id = "nuevoUsuario" placeholder="Ingresar codigo" required>

              </div>

            </div>
           
           
           
           
            <!-- ENTRADA PARA DESCRIPCION -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion"  placeholder="Ingresar descripcion" required>
                
              </div>
              
            </div>



            <!-- ENTRADA PARA SELECCIONAR LA CATEGORIA -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select name="nuevaCategoria" class="form-control input-lg" >

                  <option value="">Seleccionar categoria</option>
                  <option value="Taladro">Taladro</option>
                  <option value="Andamios">Andamios</option>
                  <option value="Equipos para construccion">Equipos para construccion</option>

                </select>

              </div>

            </div>




            <!-- ENTRADA PARA STOCK -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoStock" min="0"  placeholder="Stock" required>
                
              </div>
              
            </div>



            <div class="form-group row">

              <!-- ENTRADA PARA PRECIO COMPRA -->

              <div class="col-xs-6">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0"  placeholder="Precio de compra" required>
                  
                </div>
              </div>


              <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-6">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0"  placeholder="Precio de venta" required>
                  
                </div> 

                <br>

                <!-- CHECKBOX PARA PORCENTAJE -->

                <div class="col-xs-6">
                  <div class="form-group row">
                    <label>
                      <input type="checkbox" class="minimal porcentaje" checked="">
                      Utilizar porcentaje
                    </label>
                  </div>
                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6">
                  <div class="input-group">
                    <input type="number" class = "form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                    <span class="input-group-addon"><i class='fa fa-percent'></i></span>
                  </div>
                </div>

              </div>
              
            </div>



            <!-- ENTRADA PARA SUBIR LA FOTO -->
            <div class="form-group">
              
              <div class='panel'>Subir imagen</div>
              <!-- <input type="file"  id="nuevafoto" name="nuevaFoto"> -->
              <input type="file" class="nuevaImagen"  name="nuevaImagen">

              <p class="help-block">Peso maximo de la imagen 2 MB</p>

              <!-- foto por defecto -->
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px" alt="">

            </div>

          </div>
        </div>

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
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