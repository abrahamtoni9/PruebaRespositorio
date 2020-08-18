<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      <!-- colocamos el titulo -->
      Administrar categorias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <!-- cambiamos el titulo de la esquina derecha -->
      <li class="active">Administrar categorias</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">
      
        <!-- Trigger the modal with a button -->
        <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarCategoria'>Agregar categorias</button>

      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Categoria</th>
              <th>Acciones</th>
            </tr>
          </thead>


          <tbody>


          <?php
              $item = null;
              $valor = null;

              $categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);

              // var_dump($categorias);
              // die();
              
              foreach($categorias as $key => $value)
              {
                // var_dump($value['nombre']);

                echo '<tr>
                  <td>'.($key+1).'</td>
                  <td class = "text-uppercase">'.$value["categoria"].'</td>
                  <td>
                    <div class="btn-group">

                      <!-- BOTON EDITAR-->
                      <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                      <!--BOTON ELIMINAR-->
                      <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>
                      
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
                 MODAL AGREGAR DE CATEGORIA
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarCategoria">
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

                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaCategoria"  placeholder="Ingresar categoria" required>
                
              </div>
            </div>
          </div>
        </div>

        <!--=============================================
                  PIE DEL MODAL
        =============================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar categoria</button>
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
                 MODAL EDITAR CATEGORIA
	=============================================-->

<!-- Modal -->
<div class="modal fade" id="modalEditarCategoria">
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
                <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" value="" required>


                <!-- INPUT OCULTO -->
                <input type="hidden"  id="idCategoria" name="idCategoria">
                
              </div><!--fin input-group-->
              
            </div><!--fin form-group-->

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