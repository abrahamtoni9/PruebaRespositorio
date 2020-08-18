

/*=============================================
    CARGAR LA TABLA DINAMICA DE PRODUCTOS
=============================================*/


// $.ajax(
//     {
//         url:'ajax/datatable-productos.ajax.php',
//         success:function(respuesta)
//         {
//             console.log("respuesta : ", respuesta);
            
//         },
//         error: function()
//         {
//             console.log("No se ha podido obtener la información");
//         }
//     }
// )  //fin del ajax





// $('.tablaProductos').DataTable
// ({
//     "ajax": {
//         "url":"ajax/datatable-productos.ajax.php",
        
//     },
    
//     //para optimizar la carga de datos 
//     "processing": true,
//     "retrieve": true,
//     "processing": true,


//     // cambiamos el lenguaje de datatables
//     "language": {

//         "sProcessing":     "Procesando...",
//         "sLengthMenu":     "Mostrar _MENU_ registros",
//         "sZeroRecords":    "No se encontraron resultados",
//         "sEmptyTable":     "Ningún dato disponible en esta tabla",
//         "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//         "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
//         "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//         "sInfoPostFix":    "",
//         "sSearch":         "Buscar:",
//         "sUrl":            "",
//         "sInfoThousands":  ",",
//         "sLoadingRecords": "Cargando...",
//         "oPaginate": {
//         "sFirst":    "Primero",
//         "sLast":     "Último",
//         "sNext":     "Siguiente",
//         "sPrevious": "Anterior"
//         },
//         "oAria": {
//             "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//         }

//     }
        
        
// });






/*===================================================
    ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=====================================================*/
// $(".tablaProductos tbody").on("click","button",function()//busca de la tabla y el cuerpo, al darle click al boton
// {
//     var data = table.rows( $(this).parents('tr')).data();

//     $(this).attr("idProducto",data[9]); //captura el valor de la columna 9 y asigna al atributo o propiedad  creado idProducto en el boton que se dio click   
//     $(this).attr("codigo",data[2]); //captura el valor de la columna 2 y asigna al atributo o propiedad  creado idProducto en el boton que se dio click
//     $(this).attr("imagen",data[1]); //captura el valor de la columna 2 y asigna al atributo o propiedad  creado idProducto en el boton que se dio click
// });









/*===================================================
    CAPTURANDO LA CATEGORIA PARA ASIGNAR EL CODIGO
=====================================================*/
$('#nuevaCategoria').change(function()
{
    var idCategoria = $(this).val();//recuperamos el id 

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    
  
    datos.append("idCategoria", idCategoria);


    if (datos)
    { 
        $.ajax(
        {
            // Es importante el orden de las propiedades osino crea problema
            url:'ajax/productos.ajax.php',
            method:'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            dataType: "json",//tipo de respuesta que va a recibir
            // dataType: "html",
            success:function(respuesta)
            {
                // console.log("respuesta  : ", respuesta);

                if(!respuesta)//si no hay respuesta del servidor
                {   
                    // idCategoria va a ser igual idCategoria(con codigo 6) + "01" para que empieze desde 601
                    var nuevoCodigo =  idCategoria + "01";
                    $("#nuevoCodigo").val(nuevoCodigo);

                }
                else
                {
                    var nuevoCodigo = Number(respuesta['codigo'])+1;
                    // console.log("respuesta  : ", nuevoCodigo );
                    $("#nuevoCodigo").val(nuevoCodigo);
                }

                // var nuevoCodigo = respuesta["codigo"];
                // console.log("codigo  : ", nuevoCodigo);
                
                // $("#editarCategoria").val(respuesta["categoria"]);
                // $("#idCategoria").val(respuesta["id"]);
            },
            error: function()
            {
                console.log("No se ha podido obtener la información");
            }
        }
        )  //fin del ajax
    } //fin del if datos

});





/*===================================================
            ASINGNANDO PRECIO DE VENTA
=====================================================*/
$('#nuevoPrecioCompra, #editarPrecioCompra').change(function()
{ 
    // si el check del porcentaje esta chequeado
    if($(".porcentaje").prop("checked"))//si tiene en su propiedad el checked
    {
        // capturamos el valor del campo del porcentajey convertimos a numero
        var valorPorcentaje = Number($('.nuevoPorcentaje').val());

        var editarPorcentaje = Number($('.editarPorcentaje').val());

        // console.log("valor porcentaje : ",valorPorcentaje);
        
        // capturamos el valor del campo del precio de compra y convertimos a numero
        var precioc = Number($('#nuevoPrecioCompra').val());

        var editprecioc = Number($('#editarPrecioCompra').val());


        // calculamos el precio de venta deacuerdo al porcentaje
        var porcentaje = (precioc*valorPorcentaje/100)+precioc;

        var editarporcentaje = (editprecioc*editarPorcentaje/100)+editprecioc;

        console.log("porcentaje : ",porcentaje);
        

        $('#nuevoPrecioVenta').val(porcentaje);
        $('#nuevoPrecioVenta').prop("readonly",true);//que la propiedad readonly quede verdadera

        $('#editarPrecioVenta').val(editarporcentaje);
        $('#editarPrecioVenta').prop("readonly",true);//que la propiedad readonly quede verdadera
    }
});





/*===================================================
                CAMBIO DE PORCENTAJE
=====================================================*/

$('#nuevoPorcentaje, .editarPorcentaje').change(function()
{
    // si el check del porcentaje esta chequeado
    if($(".porcentaje").prop("checked"))//si tiene en su propiedad el checked
    {
        // capturamos el valor del campo del porcentaje y convertimos a numero
        var valorPorcentaje = Number($(this).val());//si tenemos dos elementos con la misma clase podemos hacer referencia al mismo elemento con this

        var editarPorcentaje = Number($('.editarPorcentaje').val());

        // console.log("valor porcentaje : ",valorPorcentaje);
        
        // capturamos el valor del campo del precio de compra y convertimos a numero
        var precioc = Number($('#nuevoPrecioCompra').val());

        var editprecioc = Number($('#editarPrecioCompra').val());

        // calculamos el precio de venta deacuerdo al porcentaje
        var porcentaje = (precioc*valorPorcentaje/100)+precioc;

        var editarporcentaje = (editprecioc*editarPorcentaje/100)+editprecioc;

        console.log("porcentaje : ",porcentaje);
        

        $('#nuevoPrecioVenta').val(porcentaje);
        $('#nuevoPrecioVenta').prop("readonly",true);//que la propiedad readonly quede verdadera

        $('#editarPrecioVenta').val(editarporcentaje);
        $('#editarPrecioVenta').prop("readonly",true);//que la propiedad readonly quede verdadera
        
    }
});





/*===================================================
    SI EL CHECK DEL PORCENTAJE NO ESTA ACTIVO
=====================================================*/
//si el check de porcentaje no esta activo habilitamos el input de precio venta
$(".porcentaje").on("ifUnchecked",function()
{
    // entonces habilitamos el campo de precio de venta
    $('#nuevoPrecioVenta').prop("readonly",false);
    $('#editarPrecioVenta').prop("readonly",false);

});







/*===================================================
    SI EL CHECK DEL PORCENTAJE ESTA ACTIVO
=====================================================*/
//si el check de porcentaje  esta activo deshabilitamos el input de precio venta
$(".porcentaje").on("ifChecked",function()
{
    // entonces deshabilitamos el campo de precio de venta
    $('#nuevoPrecioVenta').prop("readonly",true);
    $('#editarPrecioVenta').prop("readonly",true);

});







/*=============================================
            SUBIENDO FOTO PRODUCTO
=============================================*/

// $('.nuevaFoto').change(function()
$(document).on("change",".nuevaImagen",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{
    // files propiedad de javascript que solo funciona en los elementos de tipo file, 1 kbyte = 1000 byte , 1mbyte = 1000 kbyte, el archivo no puede pesar mas de 200.000 kbyte o 200.000.000 byte (200 mgb) 
    // capturamos el indice 0 de la imagen que vamos a subir , podrian ser varios por eso el indice
    var imagen = this.files[0];
    // console.log("imagen: ", imagen);

    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
    {
        // le asignamos valor vacio
        $(".nuevaImagen").val("");

        // mostar mensaje de error
        Swal.fire({
        type: "error",
        title: "Error al subir la imagen, la imagen debe tener formato jpeg o png!",
        confirmButtonText: "Cerrar"
        });
         
    }
    // validamos el tamano del a imagen , 2.000.000 byte equivale a 2 mgb
    else if(imagen["size"] > 2000000)
    {
          // le asignamo valor vacio
          $(".nuevaImagen").val("");

          // mostar mensaje de error
          Swal.fire({
          type: "error",
          title: "Error al subir la imagen, la imagen no debe pesar mas de 2MB!",
          confirmButtonText: "Cerrar"
          });
    }else
    {
        // lectura de archivo
        var datoImagen = new FileReader;

        // El método readAsDataURL es usado para leer el contenido del especificado Blob o File.  Cuando la operación de lectura es terminada, el readyState se convierte en DONE, y el loadend es lanzado. En ese momento, el atributo result contiene  la información como una URL representando la información del archivo como una cadena de caracteres codificados en base64.
        // le pasamos una propiedad que vamos a leer como dato  url la imagen como parametro
        datoImagen.readAsDataURL(imagen);

        // cuando la imagen esta cargado 
        $(datoImagen).on("load", function()
        {
            //EVENT.TARGET HACE referencia a un objeto que lanzo el evento
            //La propiedad event.result contiene el último / anterior valor devuelto por un controlador de eventos activado por el evento especificado. 
            // vamos a crear una ruta par ala imagen donde vamos a almacenar 
            var rutaImagen = event.target.result;

            // le pasamos el valor de la ruta al atributo src del elemento
            $(".previsualizar").attr("src", rutaImagen);
        });
    }
});








/*=============================================
            EDITAR PRODUCTO
=============================================*/

// llama al hacer click en usuarios.php en el boton editar
// $(".btnEditarUsuario").click(function()
// $(document).on("click",".btnEditarUsuario",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular

//cuando se carga la pagina no lee la clase btnEditarProducto porque se carga por via ajax 
// es por eso que debemos usar de esta manera button.btnEditarProducto(busca la clase del boton) despues de escribirse por via ajax
$(".tablaProductos tbody").on("click","button.btnEditarProducto",function()
{
    // this hace referencia al mismo elemento y al atributo idusuario
    var idproducto = $(this).attr("idProducto");

    // console.log("idProducto",idproducto);

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    
  
    datos.append("idProducto", idproducto);
    
    if (datos)
    { 
        $.ajax(
            {
                // Es importante el orden de las propiedades osino crea problema
                url:'ajax/productos.ajax.php',
                method:'POST',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                dataType: "json",//tipo de respuesta que va a recibir
                // dataType: "html",
                success:function(respuesta)
                {
                    // console.log("respuesta : ", respuesta);

                    var datosCategoria = new FormData();
                    datosCategoria.append("idCategoria",respuesta['id_categoria']);

                    $.ajax(
                        {
                            // Es importante el orden de las propiedades osino crea problema
                            url:'ajax/categorias.ajax.php',
                            method:'POST',
                            data: datosCategoria,
                            cache: false,
                            contentType: false,
                            processData: false,
                            enctype: 'multipart/form-data',
                            dataType: "json",//tipo de respuesta que va a recibir
                            // dataType: "html",
                            success:function(respuesta)
                            {
                                // console.log("categoria : ", respuesta);
                                $("#editarCategoria").val(respuesta['id']);
                                $("#editarCategoria").html(respuesta['categoria']);
                            },
                            error: function()
                            {
                                console.log("No se ha podido obtener la información de la categoria");
                            }
                        })


                        $("#editarCodigo").val(respuesta['codigo']);
                        $("#editarDescripcion").val(respuesta['descripcion']);
                        $("#editarStock").val(respuesta['stock']);
                        $("#editarPrecioCompra").val(respuesta['precio_compra']);
                        $("#editarPrecioVenta").val(respuesta['precio_venta']);

                        if(respuesta['imagen'] != "")
                        {
                            $("#imagenActual").val(respuesta['imagen']);
                            $(".previsualizar").attr("src",respuesta['imagen']);
                        }
                },
                error: function()
                {
                    console.log("No se ha podido obtener la información del producto");
                }
            })  //fin del ajax
    } //fin del if datos
});









/*=============================================
            ELIMINAR PRODUCTO
=============================================*/
//cuando se carga la pagina no lee la clase btnEditarProducto porque se carga por via ajax 
// es por eso que debemos usar de esta manera button.btnEditarProducto(busca la clase del boton) despues de escribirse por via ajax
$(".tablaProductos tbody").on("click","button.btnEliminarProducto",function()
{

    // alert( table.rows('.selected').data().length +' row(s) selected' );
    var idproducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");

    console.log("idProducto",idproducto);
    console.log("codigo",codigo);
    console.log("imagen",imagen);

    Swal.fire({
        title: 'Estas seguro de borrar el producto?',
        text: "Si no lo esta puede borrar la accion!",
        type: 'warning',//tipo
        showCancelButton: true,//habilitamos para cancelar la accion
        confirmButtonColor: '#3085d6',//color de boton
        cancelButtonColor: '#d33',//color de boto de cancelar
        cancelButtonText: 'Cancelar!',//texto de cancelar 
        confirmButtonText: 'Si, borrar producto !'//texto de confirmar
        }).then(function(result){
        if (result.value) {
            // debemos capturar el id de categoria
            //debemos recordar que configuramos el regwrite a RewriteRule ^([-a-zA-Z0-9]+)$ index.php?ruta=$1
            window.location = "index.php?ruta=productos&idProducto="+idproducto+"&imagen="+imagen+"&codigo="+codigo;
            // window.location = "index.php?ruta=usuarios&idUsuarios="+idUsuario+"&usuario="+usuario+"fotoUsuario="+fotoUsuario;
            // header("Location:http://localhost/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
            // header("Location:http://localhost:81/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
        }
    })
});





