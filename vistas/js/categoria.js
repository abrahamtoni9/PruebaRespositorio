

/*=============================================
            EDITAR CATEGORIA
=============================================*/

// llama al hacer click en cateogoria.php en el boton editar
// $(".btnEditarCategoria").click(function()
$(document).on("click",".btnEditarCategoria",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{
    // this hace referencia al mismo elemento y al atributo idusuario
    var idcategoria = $(this).attr("idCategoria");

    // console.log("idUsuario",idusuario);

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    
  
    datos.append("idCategoria", idcategoria);
    
    if (datos)
    { 
        $.ajax(
            {
                // Es importante el orden de las propiedades osino crea problema
                url:'ajax/categorias.ajax.php',
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
                    console.log("respuesta : ", respuesta);
                    $("#editarCategoria").val(respuesta["categoria"]);
                    $("#idCategoria").val(respuesta["id"]);
                },
                error: function()
                {
                    console.log("No se ha podido obtener la información");
                }
            }
        )  //fin del ajax
    } //fin del if datos
});












/*=============================================
        REVISAR  CATEGORIA REPETIDO
=============================================*/

// cuando escribimos el usuario escucha el evento 
// $("#nuevoUsuario").change(function()
$(document).on("change","#nuevoUsuario",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{

    $(".alert").remove();

    // capturamos el valor del usuario 
    var usuario = $(this).val();

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    
  
    datos.append("validarUsuario", usuario);

    if (datos)
    { 

        // alert('hola');
        $.ajax(
            {
                // Es importante el orden de las propiedades osino crea problema
                url:'ajax/usuarios.ajax.php',
                method:'POST',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                dataType: "JSON",//tipo de respuesta que va a recibir
                // dataType: "html",
                success:function(respuesta)
                {
                    // console.log("respuesta : ", respuesta);
                    if(respuesta)
                    {
                        // $("#nuevoUsuario").before('<div class = "alert alert-warning">Este usuario ya existe en la base de datos</div>');
                        // colocamos un mensaje debajo del elemento indicando que ya existe el usuario
                        $("#nuevoUsuario").parent().after('<div class = "alert alert-warning">Este usuario ya existe en la base de datos</div>');
                        $("#nuevoUsuario").val("");
                    }
                },
                error: function()
                {
                    console.log("No se ha podido obtener la información");
                }
            }
        )  //fin del ajax
    } //fin del if datos

});









/*=============================================
            ELIMINAR  CATEGORIA 
=============================================*/

// $(".btnEliminarUsuario").click(function()
$(document).on("click",".btnEliminarCategoria",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{


    // capturamos las propiedades del boton eliminar
    var idCategoria =  $(this).attr("idCategoria");     
    
    // mostramos en la consola si captura bien las variables
    console.log(idCategoria);
   


    Swal.fire({
        title: 'Estas seguro de borrar la categoria?',
        text: "Si o lo esta puede borrar la accion!",
        type: 'warning',//tipo
        showCancelButton: true,//habilitamos para cancelar la accion
        confirmButtonColor: '#3085d6',//color de boton
        cancelButtonColor: '#d33',//color de boto de cancelar
        cancelButtonText: 'Cancelar!',//texto de cancelar 
        confirmButtonText: 'Si, borrar categoria!'//texto de confirmar
      }).then(function(result){
        if (result.value) {
            // debemos capturar el id de categoria
            //debemos recordar que configuramos el regwrite a RewriteRule ^([-a-zA-Z0-9]+)$ index.php?ruta=$1
            window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
            // window.location = "index.php?ruta=usuarios&idUsuarios="+idUsuario+"&usuario="+usuario+"fotoUsuario="+fotoUsuario;
            // header("Location:http://localhost/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
            // header("Location:http://localhost:81/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
        }
      })
})

