/*=============================================
            SUBIENDO FOTO USUARIO
=============================================*/

// $('.nuevaFoto').change(function()
$(document).on("change",".nuevaFoto",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
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
        $(".nuevaFoto").val("");

        // mostar mensaje de error
        Swal.fire({
        type: "error",
        title: "Error al subir la imagen, la imagen debe tener formato jpeg o png!",
        text: "La imagen debe estar en formato JPG o PNG",
        confirmButtonText: "Cerrar"
        });
         
    }
    // validamos el tamano del a imagen , 2.000.000 byte equivale a 2 mgb
    else if(imagen["size"] > 2000000)
    {
          // le asignamo valor vacio
          $(".nuevaFoto").val("");

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
            EDITAR USUARIO
=============================================*/

// llama al hacer click en usuarios.php en el boton editar
// $(".btnEditarUsuario").click(function()
$(document).on("click",".btnEditarUsuario",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{
    // this hace referencia al mismo elemento y al atributo idusuario
    var idusuario = $(this).attr("idUsuario");

    // console.log("idUsuario",idusuario);

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    
  
    datos.append("idUsuario", idusuario);
    
    if (datos)
    { 
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
                dataType: "json",//tipo de respuesta que va a recibir
                // dataType: "html",
                success:function(respuesta)
                {
                    console.log("respuesta : ", respuesta);
                    $("#editarNombre").val(respuesta["nombre"]);
                    $("#editarUsuario").val(respuesta["usuario"]);

                    //valor de etiqueta como valor y como texto de la etiqueta
                    $("#editarPerfil").html(respuesta["perfil"]);//como texto de la etiqueta
                    $("#editarPerfil").val(respuesta["perfil"]);//como value de la etiqueta

                    // seteamos al input oculto de la foto actual 
                    $("#fotoActual").val(respuesta["foto"]);

                    // seteamos el pass en el input oculto 
                    $("#passwordActual").val(respuesta["password"]);
                
                    if(respuesta["foto"] != ""){//si el valor de foto en la bd es diferente a vacio 
                        
                        $(".previsualizar").attr("src", respuesta["foto"]);
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
            ACTIVAR  USUARIO
=============================================*/
// $(".btnActivar").click(function()
$(document).on("click",".btnActivar",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{

    // capturamos los valores
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    // console.log(idUsuario);
    // console.log(estadoUsuario);

    // Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest. Están destinados principalmente para el envío de los datos del formulario, pero se pueden utilizar de forma independiente con el fin de transmitir los datos tecleados. Los datos transmitidos estarán en el mismo formato que usa el método submit() del formulario para enviar los datos si el tipo de codificación del formulario se establece en "multipart/form-data".
    // le agregamos (variable pos , variable capturado)
    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

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
                // enctype: 'multipart/form-data',
                // dataType: "json",//tipo de respuesta que va a recibir
                dataType: "html",
                success:function(respuesta)
                {
                    console.log(respuesta);

                    // si estamos en una resolucion pequena maxima de ancho de 767px
                    if(window.matchMedia("(max-width:767px)").matches){
                        // MOSTRAMOS UNA ALERTA SUAVE
                        Swal.fire({
							type: "success",
							title: "El usuario se editó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						// }).then((result)=>{
						}).then(function(result){
							if(result.value)
							{
								window.location = "usuarios";//SE RECARGA LA PAGINA A USUARIOS
							}
						});
                    }
                },
                error: function()
                {
                    console.log("No se ha podido actualizar estado");
                }
            }
        )  //fin del ajax

        if(estadoUsuario == 0)
        {
            $(this).removeClass('btn-success'); 
            $(this).addClass('btn-danger'); 
            $(this).html('Desactivado'); 
            $(this).attr('estadoUsuario',1); 
        }
        else
        {
            $(this).addClass('btn-success'); 
            $(this).removeClass('btn-danger'); 
            $(this).html('Activado'); 
            $(this).attr('estadoUsuario',0);
        }

    } //fin del if datos

});





/*=============================================
        REVISAR  USUARIO REPETIDO
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
            ELIMINAR  USUARIO 
=============================================*/

// $(".btnEliminarUsuario").click(function()
$(document).on("click",".btnEliminarUsuario",function()//cuando el documento este cargado busca la clase btnEditarUsuario en cualquier momento incluso cuando se le de click al boton + en pantalla de celular
{


    // capturamos las propiedades del boton eliminar
    var idUsuario =  $(this).attr("idUsuario");    
    var fotoUsuario =  $(this).attr("fotoUsuario");   
    var usuario =  $(this).attr("usuario");   
    
    // mostramos en la consola si captura bien las variables
    console.log(idUsuario);
    console.log(fotoUsuario);
    console.log(usuario);


    Swal.fire({
        title: 'Estas seguro de borrar el usuario?',
        text: "Si o lo esta puede borrar la accion!",
        type: 'warning',//tipo
        showCancelButton: true,//habilitamos para cancelar la accion
        confirmButtonColor: '#3085d6',//color de boton
        cancelButtonColor: '#d33',//color de boto de cancelar
        cancelButtonText: 'Cancelar!',//texto de cancelar 
        confirmButtonText: 'Si, borrar usuario!'//texto de confirmar
      }).then(function(result){
        if (result.value) {
            console.log("verdadero");
            // debemos capturar el id de usuario y la ruta de la foto
            //debemos recordar que configuramos el regwrite a RewriteRule ^([-a-zA-Z0-9]+)$ index.php?ruta=$1
            window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
            // window.location = "index.php?ruta=usuarios&idUsuarios="+idUsuario+"&usuario="+usuario+"fotoUsuario="+fotoUsuario;
            // header("Location:http://localhost/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
            // header("Location:http://localhost:81/pos/inventario_venta/index.php?ruta=usuarios&idUsuario="+idUsuario+"&fotoUsuario="+fotoUsuario+")");
        }
      })
})

