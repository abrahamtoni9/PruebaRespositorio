<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
        Administrar productos
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <!-- <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarProducto'>Agregar Producto</button> -->
        
      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablaProductos tabla">
        
          <thead>
          

           <!-- <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr> -->

            <tr>
            
              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Depósito</th>
              <th>Descripción</th>
              <th>Talle</th>
              <th>Color</th>
              <th>Ref.</th>
              <th>Marca</th>
              <th>Stock</th>
            
            </tr>

          </thead>

          <tbody>

            <?php
                $item = null;
                $valor = null;

                $productos = ControladorProductos::ctrMostrarProductos($item,$valor);

                //  var_dump($usuarios);
                
                foreach($productos as $key => $value)
                {
                  // var_dump($value['nombre']);


                   /*==========================================
                                BOTON DE STOCK
                    ===========================================*/

                    if($value['cantidadxunidad'] <= 5)
                    {   //ROJO
                        $stock = "<button class='btn btn-danger'>".$value['cantidadxunidad'] ."</button>";
                    }
                    else if($value['cantidadxunidad'] > 6 && $value['cantidadxunidad']  <= 10)
                    {   //AMARILLO
                        $stock = "<button class='btn btn-warning'>".$value['cantidadxunidad']."</button>"; 
                    }
                    else
                    {   //VERDE
                        $stock = "<button class='btn btn-success'>".$value['cantidadxunidad']."</button>";
                    }

                  echo '
                  <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["codigo"].'</td>
                    <td>'.$value["deposito"].'</td>
                    <td>'.$value["descripcion"].'</td>
                    <td>'.$value["talle"].'</td>
                    <td>'.$value["color"].'</td>
                    <td>'.$value["ref"].'</td>
                    <td>'.$value["vmarcas"].'</td>
                    <td>'.$stock.'</td>
                  </tr>';

                }
            ?>

          
          </tbody>
        
        </table>

      </div>
      
      <div class="box-footer">
        Footer
      </div>
      
    </div>

  </section>

</div>



















