

/*=============================================
            EDITAR CATEGORIA
=============================================*/

// llama al hacer click en cateogoria.php en el boton editar
// $(".btnEditarCategoria").click(function()
$(document).on("click",".btnEditarCliente",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{
    // this hace referencia al mismo elemento y al atributo idusuario
    var idcliente = $(this).attr("idCliente");

    // console.log("idUsuario",idusuario);

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    
  
    datos.append("idCliente", idcliente);
    
    if (datos)
    { 
        $.ajax(
            {
                // Es importante el orden de las propiedades osino crea problema
                url:'ajax/clientes.ajax.php',
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

                    $("#idCliente").val(respuesta["id"]);
                    $("#editarCliente").val(respuesta["nombre"]);
                    $("#editarDocumentoId").val(respuesta["documento"]);
                    $("#editarEmail").val(respuesta["email"]);
                    $("#editarTelefono").val(respuesta["telefono"]);
                    $("#editarDireccion").val(respuesta["direccion"]);
                    $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
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
            ELIMINAR  CLIENTE 
=============================================*/

// $(".btnEliminarUsuario").click(function()
$(document).on("click",".btnEliminarCliente",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{


    // capturamos las propiedades del boton eliminar
    var idCliente =  $(this).attr("idCliente");     
    
    // mostramos en la consola si captura bien las variables
    console.log(idCliente);
   


    Swal.fire({
        title: 'Estas seguro de borrar el cliente?',
        text: "Si o lo esta puede borrar la accion!",
        type: 'warning',//tipo
        showCancelButton: true,//habilitamos para cancelar la accion
        confirmButtonColor: '#3085d6',//color de boton
        cancelButtonColor: '#d33',//color de boto de cancelar
        cancelButtonText: 'Cancelar!',//texto de cancelar 
        confirmButtonText: 'Si, borrar cliente!'//texto de confirmar
      }).then(function(result){
        if (result.value) {
            // debemos capturar el id de categoria
            //debemos recordar que configuramos el regwrite a RewriteRule ^([-a-zA-Z0-9]+)$ index.php?ruta=$1
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
            // window.location = "index.php?ruta=usuarios&idUsuarios="+idUsuario+"&usuario="+usuario+"fotoUsuario="+fotoUsuario;
            // header("Location:http://localhost/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
            // header("Location:http://localhost:81/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
        }
      })
})

