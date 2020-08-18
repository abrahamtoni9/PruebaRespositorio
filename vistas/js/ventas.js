
/*=============================================
            VARIABLE LOCALSTORAGE 
=============================================*/

if(localStorage.getItem("capturarRango") != null)
{
    $("#daterange-btn span").html(localStorage.getItem("capturarRango"));
}
else
{
    $("#daterange-btn span").html("<i class='fa fa-calendar'></i>Rango de fecha");
}





// const formato = new Intl.NumberFormat('en');
const formato = new Intl.NumberFormat('de-DE');




/*=============================================
            RECUPERAR PRODUCTOS 
=============================================*/

// $.ajax(
//     {
//         // Es importante el orden de las propiedades osino crea problema
//         url:'ajax/datatable-ventas.ajax.php',
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


/*============================================================
            RECUPERAR PRODUCTOS CON PLUGINS DATATABLES
=============================================================*/


$('.tablaVentas').DataTable
({
    "ajax": {
        "url":"ajax/datatable-ventas.ajax.php",
    },

    "pageLength": 7,
    
    //para optimizar la carga de datos 
    "processing": true,
    "retrieve": true,
    "processing": true,


    // cambiamos el lenguaje de datatables
    "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }       
        
});







/*=================================================================
        AGREGANDO PRODUCTO A LA VENTA DESDE LA TABLA PRODUCTO
==================================================================*/

$(".tablaVentas tbody").on("click","button.agregarProducto", function()
{
    var idProducto = $(this).attr("idProducto");
    // console.log("idProducto",idProducto);

    // removemos las clases
    $(this).removeClass("btn-primary agregarProducto")

    // mostramos en boton en gris como desactivado
    $(this).addClass("btn-default");


    var datos = new FormData();
    datos.append("idProducto", idProducto);

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
                    
                    var descripcion = respuesta['descripcion'];
                    var stock = respuesta['stock'];
                    // var nuevoStock = respuesta['stock']-1;
                    var precio = respuesta['precio_venta'];
                    
                    
                    // console.log(" stock de la bd : ", respuesta['stock']);



                    /*============================================================
                            EVITAR AGREGAR PRODUCTO CUANDO EL STOCK ESTA EN 0
                    =============================================================*/

                    if (stock == 0) {
                        Swal.fire({
                            title: 'No hay stock disponible',
                            type: 'error',//tipo
                            confirmButtonText: 'Cerrar!'//texto de confirmar
                          });

                        // regresa a color azul el boton del detalle una vez que se da click, osino no se volveria a agregar  
                        $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

                        return;
                    }

                    $(".nuevoProducto").append(
                    '<div class="row" style="padding:5px 15px">'+

                        '<!-- descripcion del producto -->'+
                        '<div class="col-xs-6" style="padding-right:0px">'+

                            '<div class="input-group">'+

                                '<!-- boton para eliminar producto -->'+
                                '<span class="input-group-addon">'+

                                '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button>'+
                                '</span>'+

                                '<!-- campo para agregar producto -->'+
                                '<input type="text" class="form-control nuevaDescripcionProducto" name="agregarProducto" id="agregarProducto"  idProducto="'+idProducto+'" placeholder="Descripcion del producto" value="'+descripcion+'" readonly required>'+

                            '</div>'+

                        '</div>'+



                        '<!-- cantidad del producto -->'+
                        '<div class="col-xs-3">'+

                            '<!-- campo para modifica la cantidad del producto a vender -->'+
                            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" id="nuevaCantidadProducto" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" min="1" value="1"  required>'+

                        '</div>'+



                        '<!-- Precio del producto -->'+
                        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

                            '<div class="input-group">'+

                                '<span class="input-group-addon">'+
                                '<i class="ion ion-social-usd"></i>'+
                                '</span>'+

                                '<!-- campo para el nuevo precio del producto -->'+
                                '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" id="nuevoPrecioProducto "  value="'+precio+'" readonly  required>'+

                            '</div>'+

                        '</div>'+

                    '</div>')

                    //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios()


                    //AGREGAR IMPUESTO
                    agregarImpuesto()

                    
                    // AGRUPAR PRODUCTOS EN FORMATO JSON
                    listarProducto()

                    //COLOCAR FORMATO DE MILES Y DECIMALES A LOS INPUTS DE NUMEROS
                    $(".nuevoPrecioProducto").number(true,2);
                },
                error: function()
                {
                    console.log("No se ha podido obtener la información");
                }
            }
        )  //fin del ajax
    } //fin del if datos
});
















/*==================================================================
    CUANDO CARGUE LA TABLA DETALLE CADA VEZ QUE NAVEGUE EN ELLA
====================================================================*/

// El draw evento se dispara siempre que la tabla se vuelve a dibujar en la página. Tenga en cuenta que todos los eventos de DataTables se activan con el dtespacio de nombres. Este espacio de nombres de eventos es para evitar conflictos con eventos personalizados activados por otras bibliotecas Javascript. Como tal, debe agregar .dtel nombre de los eventos que está escuchando (cuando se utiliza on()el espacio de nombres se agrega automáticamente si es necesario
$(".tablaVentas").on("draw.dt",function()
{
    // console.log("tabla");

    // si existe en el localStorage el item quitarProducto
    if(localStorage.getItem("quitarProducto") != null)
    {
        // creamos la variable y parseamos a objeto JSON la cadena String de localStorage
        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        // recorremos la variable
        for ($i = 0; $i < listaIdProductos.length; $i++) 
        {
            // seleccionamos el boton con la clase recuperarBoton, y esta etiqueta tiene oto atributo con el valor el id del producto, y le vamos a remover la clase btn-default
            $("button.recuperarBoton[idProducto='"+listaIdProductos[$i]["idProducto"]+"']").removeClass("btn-default");
            
            // al mismo boton vamos a agregarle la clase btn-primary y agregarProducto
            $("button.recuperarBoton[idProducto='"+listaIdProductos[$i]["idProducto"]+"']").addClass("btn-primary agregarProducto");
        }
    }

});
















/*==================================================================
        QUITAMOS PRODUCTO DE LA VENTA Y RECUPERACION DEL BOTON 
====================================================================*/

var idQuitarProducto = [];

// cada vez que recargamos la pagina entonces eliminamos el localStorage "quitarProducto"
localStorage.removeItem("quitarProducto");

// Cuando el formulario venta esta cargado de los elementos o registros agregados desde tabla detalle
// la clase quitarProducto viene del boton cancelar donde se crea en forma dinamica en el evento click del boton agregarProducto
$(".formularioVenta").on("click","button.quitarProducto", function()
{

    $(this).parent().parent().parent().parent().remove();

    // recuperamos el id de la propiedad idProducto del boton cancelar
    var idProducto = $(this).attr("idProducto");

    /*==================================================================
        ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR 
    ====================================================================*/

    // si existe el localStorage quitarProducto y es nulo
    if(localStorage.getItem("quitarProducto") == null)
    {
        // cremoa una variable de tipo array vacio
        idQuitarProducto = [];
    }
    else //si viene con informacion
    {
        // concatenamos 
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    }

    // insertamos dato JSON una vez creado, la propiedad idProducto y le asingamos el valor de la variable idProducto
    idQuitarProducto.push({"idProducto": idProducto});


    // vamos a subir al localStorage la propiedad quitarProducto con el valor de idQuitarProducto formateado a  JSON 
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));



    // seleccionamos el boton con la clase recuperarBoton, y esta etiqueta tiene oto atributo con el valor el id del producto, y le vamos a remover la clase btn-default
    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass("btn-default");

    // al mismo boton vamos a agregarle la clase btn-primary y agregarProducto
    $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

    // si no hay filas de productos en la cabeceral
    if($(".nuevoProducto").children().length == 0)
    {
        // input del total de las sumas de los precion en crear-venta
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
    }
    else
    {
        //SUMAR TOTAL DE PRECIOS
        sumarTotalPrecios();
        
        //AGREGAR IMPUESTO
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProducto()
    }
    
});

















/*==================================================================================================
        AGREGAR PRODUCTO DESDE EL BOTON AGREGAR PRODUCTO PARA PANTALLA MEDIANA PEQUENA Y MOVIL 
===================================================================================================*/

var numProducto = 0;


// $(".btnAgregarProducto").click(function()
$(".btnAgregarProducto").on("click", function()
{
    numProducto++;

    var datos = new FormData();

    datos.append("traerProductos", "ok");

    if (datos)
    { 
        // alert('hola');
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
                dataType: "JSON",//tipo de respuesta que va a recibir
                // dataType: "html",
                success:function(respuesta)
                {
                    // jQuery('#sub_cat').html(respuesta);
                    // console.log("respuesta : ", respuesta);

                    $(".nuevoProducto").append(
                        '<div class="row" style="padding:5px 15px">'+
    
                            '<!-- descripcion del producto -->'+
                            '<div class="col-xs-6" style="padding-right:0px">'+
    
                                '<div class="input-group">'+
    
                                    '<!-- boton para eliminar producto -->'+
                                    '<span class="input-group-addon">'+
    
                                    '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button>'+
                                    '</span>'+
    
                                    '<!-- campo para agregar producto -->'+
                                    
                                    // '<select name="nuevaDescripcionProducto" class="form-control select2 nuevaDescripcionProducto agregarProducto" id="producto'+numProducto+'" idProducto="'+idProducto+'" style="width: 95%">'+
                                    '<select name="nuevaDescripcionProducto" class="form-control select2 nuevaDescripcionProducto agregarProducto" id="producto'+numProducto+'" idProducto style="width: 95%">'+

                                    '<option value="">Seleccionar el producto</option>'+

                                    '</select>'+
                                    
                                '</div>'+
    
                            '</div>'+
    
    
    
                            '<!-- cantidad del producto -->'+
                            '<div class="col-xs-3 ingresoCantidad">'+
    
                                '<!-- campo para modifica la cantidad del producto a vender -->'+
                                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto"'+ 'id="nuevaCantidadProducto" min="1" value="1" stock  nuevoStock required>'+
                                // '<input type="number" min="1" value="1">'+

    
                            '</div>'+
    
    
    
                            '<!-- Precio del producto -->'+
                            '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
    
                                '<div class="input-group">'+
    
                                    '<span class="input-group-addon">'+
                                    '<i class="ion ion-social-usd"></i>'+
                                    '</span>'+
    
                                    '<!-- campo para el nuevo precio del producto -->'+
                                    '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal readonly required>'+
    
                                '</div>'+
    
                            '</div>'+
    
                        '</div>')


                    //AGREGAR LOS PRODUCTOS AL SELECT

                    // recorremos la respuesta
                    respuesta.forEach(funcionForeach);

                    function funcionForeach(item, index)//el item se convierte en cada una de las columnas de la tabla de la bd
                    {   
                        // Evita que se cargue los producto con stock 0
                        if(item.stock != 0)
                        {
                            // adicionamos en el select usando el id paraque no duplique los registros seleccionados al querer agregar mas filas en el detalle
                            $("#producto"+numProducto).append(
                                '<option idProducto = "'+item.id+'" value = "'+item.descripcion+'">'+item.descripcion+'</option>' 
                            );
                        }

                    }  

                    // //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios()

                    //AGREGAR IMPUESTO
                    agregarImpuesto()

                    //COLOCAR FORMATO DE MILES Y DECIMALES A LOS INPUTS DE NUMEROS
                    $(".nuevoPrecioProducto").number(true,2);


                    // AGRUPAR PRODUCTOS EN FORMATO JSON
                    // listarProducto()

                    // La otra forma de recorrer


                    // jQuery.each(data, function(index, item) {
                    //     //now you can access properties using dot notation
                    // });



                    // var dataItems = "";
                    // $.each(data, function (index, itemData) {
                    //     dataItems += index + ": " + itemData + "\n";
                    // });
                    // console.log(dataItems);




                    // funcion map
                    
                    // var mapArray = {
                    //     "lastName": "Last Name cannot be null!",
                    //     "email": "Email cannot be null!",
                    //     "firstName": "First Name cannot be null!"
                    //   };
                      
                    //   $.map(mapArray, function(val, key) {
                    //     alert("Value is :" + val);
                    //     alert("key is :" + key);
                    //   });


                    // https://stackoverflow.com/questions/733314/jquery-loop-over-json-result-from-ajax-success
                },

                error: function()
                {
                    console.log("No se ha podido obtener la información");
                }
            }
        )  //fin del ajax
    } //fin del if datos
})


















/*==========================================================
        SELECCIONAR PRODUCTO EN PANTALLA DE DISPOSITIVO
============================================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function()
{
    // tomamos el id del producto de la propiedad del select
    // var nombreProducto = $(this).val();  
    // var idProducto = $(this).attr("idProducto");//con la propiedad de idProducto no me toma el valor entonces hacemos con el value 
    var nombreProducto = $(this).val(); 
    // var idProducto = $(".nuevaDescripcionProducto").attr("idProducto"); 

    var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

    // console.log("idProducto : ",idProducto);

    // con this nos va a ubicar en el elemento que damos click y vamos a buscar la caja de precio producto
    var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    
    // con this nos va a ubicar en el elemento que damos click y vamos a buscar la caja de precio producto
    var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    // console.log("nombreProducto : ", nombreProducto);

    var datos = new FormData();

    datos.append("nombreProducto", nombreProducto);


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
            dataType: "JSON",//tipo de respuesta que va a recibir
            // dataType: "html",
            success:function(respuesta)
            {
                // console.log(respuesta);
                // console.log(respuesta["stock"]);
                
                
                console.log(nuevoPrecioProducto);
                // console.log(nuevaCantidadProducto);

                // var nuevoStock = respuesta['s']
                
                
                // le asignamos el valor de la bd a la propiedad stock del input de stock que se creo en forma dinamica 
                $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
                $(nuevaCantidadProducto).attr("nuevoStock", respuesta["stock"]-1);
                // $("#nuevaCantidadProducto").attr("stock", respuesta["stock"]);
                
                // $("#nuevoPrecioProducto").val(formato.format(respuesta["precio_venta"]));
                // $(nuevoPrecioProducto).val(formato.format(respuesta["precio_venta"]));
                $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
                
                $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);


                // $(".nuevaDescripcionProducto").attr("idProducto", respuesta["id"]);
                $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);


                // //SUMAR TOTAL DE PRECIOS
                sumarTotalPrecios()

                //AGREGAR IMPUESTO
                // agregarImpuesto()



                // AGRUPAR PRODUCTOS EN FORMATO JSON
                listarProducto()



            },
            error: function()
            {
                console.log("No se ha podido obtener la información");
            }
        })  //fin del ajax
    } //fin del if datos

})



















/*===========================================
            MODIFICAR LA CANTIDAD 
==============================================*/

// nuevaCantidadProducto debe estar en los inputs de stock de las pantallas de escritorio y de dispositivo movil
$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function()
{

    // salimos en dos parent y llega al div class="row", llegamos al hijo con la clase ingresoPrecio y bajo a dos hijos y el tercer hijo buscamos con el id nuevoPrecioProducto
    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    // console.log("input precio : ", precio);
    // console.log("input valor precio: ", precio.val());

    // console.log("valor cantidad: ", $(this).val());

    // calculamos el la cantidad del producto por el precio del producto
    // var precioFinal = $(this).val().replace(".","") * precio.val().replace(".","");
    // var precioFinal = Number.parseFloat($(this).val().replace(".","")) * Number.parseFloat(precio.val().replace(".",""));
    var precioFinal = $(this).val() * precio.attr("precioReal");

    // seteamos el valor calculado
    // precio.val(formato.format(precioFinal));
    precio.val(precioFinal);


    // restamos el stock con el valor ingresado en la cantidad
    var nuevoStock = Number($(this).attr("stock")) - $(this).val();


    // modificamos el nuevo stock
    $(this).attr("nuevoStock", nuevoStock);


    // si la cantidad supera el stock 
    if(Number($(this).val()) > Number($(this).attr("stock")))
    {

        // si la cantidad supera el stock seteamos a 0 el campo de cantidad
        $(this).val(1);
        
        // y volvemos a calcular la cantidad de 1 por el precio real
        var precioFinal = $(this).val() * precio.attr("precioReal");

        // y seteamos el calcula al campo de precio del producto
        precio.val(precioFinal);

        // llamamos a la funcion suma de todos los precios para que siempre actualize
        sumarTotalPrecios();

        //AGREGAR IMPUESTO
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProducto()

        Swal.fire({
            title: 'La cantidad supera el stock',
            text: 'Solo hay '+$(this).attr("stock")+' unidades ',
            type: 'error',//tipo
            confirmButtonText: 'Cerrar!'//texto de confirmar
        });
    }

    //SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios();

    //AGREGAR IMPUESTO
    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProducto()
});


















/*===========================================
            SUMAR TODOS LOS PRECIOS
==============================================*/

function sumarTotalPrecios()
{
    // capturamos como un array en cada indice es una clase de todos los precio del producto de la cabecera    
    var precioItem = $(".nuevoPrecioProducto");

    var arraySumaPrecio = [];

    // console.log("precioItem : ", precioItem);
    
    // // recorremos todos los indices del array de item
    for (var i = 0; i < precioItem.length; i++) {
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
        
    }
    // console.log("arraySumaPrecioProducto : ",arraySumaPrecio);


    // //numero seria el indice de la clase nuevoPrecioProducto y cuando le pasemos la funcion como parametro en reduce y se va a sumar entre si para tener el total
    function sumaArrayPrecios(total, numero)
    {
        return total + numero;
    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    // console.log( "sumaTotalPrecio : ",sumaTotalPrecio);

    // $("#nuevoTotalVenta").val(Number(sumaTotalPrecio));
    $("#nuevoTotalVenta").val(sumaTotalPrecio);
    $("#totalVenta").val(sumaTotalPrecio);
    $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);
}















/*===========================================
            AGREGAR IMPUESTO
==============================================*/

function agregarImpuesto()
{ 
    // capturamos el campo de impuesto
    var impuesto = $("#nuevoImpuestoVenta").val();
    
    // capturamos el campo de precio total
    var precioTotal = $("#nuevoTotalVenta").attr("total");

    var precioImpuesto = Number(precioTotal * impuesto /100);

    var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

    $("#nuevoTotalVenta").val(totalConImpuesto);
    
    $("#totalVenta").val(totalConImpuesto);

    $("#nuevoPrecioImpuesto").val(precioImpuesto);

    $("#nuevoPrecioNeto").val(precioTotal);

}

















/*===========================================
            CUANDO CAMBIA EL IMPUESTO
==============================================*/
$("#nuevoImpuestoVenta").change(function()
{
    agregarImpuesto()
})




















/*===========================================
            FORMATO AL PRECIO FINAL
==============================================*/

//COLOCAR FORMATO DE MILES Y DECIMALES A LOS INPUTS DE TOTALES
$("#nuevoTotalVenta").number(true,2);





















/*==========================================================
        SELECCIONAR METODO DE PAGO
============================================================*/

// $(".nuevoMetodoPago").on("change",(function()
$("#nuevoMetodoPago").change(function()
{
    var metodo = $(this).val();

    // console.log("pago : ", metodo);
    // console.log("tipo  : ", typeof(metodo));

    if(metodo == "Efectivo")
    {

        // alert("hola");
        // removemos la clase de la caja padre del select
        // var caja =  $(this).parent().parent();
        $(this).parent().parent().removeClass("col-xs-6");

        // console.log("caja : ", caja);
        
        // agregamos la clase de la caja padre del select para reducir el tamano
        $(this).parent().parent().addClass("col-xs-4");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            ' <div class="col-xs-4">'+
            
                '<div class="input-group">'+
            
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                    
                    ' <input type="text" class="form-control" id="nuevoValorEfectivo" name="nuevoValorEfectivo" placeholder="0000" required>'+
                
                '</div>'+
                
            '</div>'+
                
            '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+
                
                '<div class="input-group">'+
                
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                    '<input type="text" class="form-control nuevoCambioEfectivo" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="0000" readonly required>'+
                
                '</div>'+

            '</div>'
        )

        // AGREGAR FORMATO DE NUMEROS
        $("#nuevoValorEfectivo").number(true,2);
        $("#nuevoCambioEfectivo").number(true,2);

        // listar metodo en la entrada
        listarMetodos();
    }
    else
    {
        $(this).parent().parent().removeClass("col-xs-4");

        $(this).parent().parent().addClass("col-xs-6");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            ' <div class="col-xs-6" style="padding-left:0px">'+

                '<div class="input-group">'+

                    ' <input type="text" class="form-control" name="nuevoCodigoTransaccion" id="nuevoCodigoTransaccion"  placeholder="Codigo de transaccion" required>'+

                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+

                '</div>'+

            '</div>'
        )

    }
})
// }))


















/*==========================================================
                    CAMBIO EN EFECTIVO
============================================================*/

$(".formularioVenta").on("change", "input#nuevoValorEfectivo",(function()
{
    var efectivo = $(this).val();//captura el valor de efectivo

    var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('.nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);
}))

















/*==========================================================
                CAMBIO EN TRANSACCION
============================================================*/

$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion",(function()
{
    listarMetodos()
}))



















/*==========================================================
                    CAMBIO EN TRANSACCION
============================================================*/

$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion",(function()
{
    // ejecutamos la funcion en el que vamos a concatenar con el valor del select de forma de pago 
    listarMetodos()
}))


















/*==========================================================
                LISTAR TODOS LOS PRODUCTOS
============================================================*/


function listarProducto()
{
    var listaProductos = [];

    // descripcion del producto de las pantallas grandes y moviles
    // capturampos por clase para almacenar todos las clases en forma de array que se generan en forma dinamica para luego recorrer en el for
    // var descripcion = $(".nuevaDescripcionProducto").attr("idProducto");
    var descripcion = $(".nuevaDescripcionProducto");
    // var descripcion = $(".nuevaDescripcionProducto").val();
    
    // console.log("id : ", descripcion);

    // cantidad del producto
    var cantidad = $(".nuevaCantidadProducto");

    // // precio del producto
    var precio = $(".nuevoPrecioProducto");

    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({"id" : $(descripcion[i]).attr("idProducto"), //descipcion viene de seleccionar con jquery con todos sus indices 
                                "descripcion" : $(descripcion[i]).val(),
                                "cantidad" : $(cantidad[i]).val(),
                                "stock" : $(cantidad[i]).attr("nuevoStock"),
                                "precio" : $(precio[i]).attr("precioReal"),
                                "total" : $(precio[i]).val()
                            });

    }

    // console.log("lista : ", listaProductos);
    console.log("lista : ", JSON.stringify(listaProductos));


    $("#listaProductos").val(JSON.stringify(listaProductos));
}










/*==========================================================
                LISTAR METODO DE PAGO
============================================================*/

function listarMetodos()
{
    var listarMetodos = "";
    
    // si el valor del select es efectivo 
    if($("#nuevoMetodoPago").val() == "Efectivo")
    {
        // asignamos el valor al input oculto
        $("#listaMetodoPago").val("Efectivo")
    }
    else
    {
        // si no concatenamos el valor de tc o td con el numero de transaccion
        $("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
    }
    
}










/*==========================================================
                BOTON EDITAR VENTA
============================================================*/

// $(".btnEditarVenta").click(function()
$(".tabla").on("click", "button.btnEditarVenta",(function()

{
    var idVenta = $(this).attr("idVenta");

    window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
}))










/*==========================================================
                BOTON ELIMINAR VENTA
============================================================*/

// $(".btnEliminarVenta").click(function()
$(".tabla").on("click", ".btnEliminarVenta",(function()
{
    var idVenta = $(this).attr("idVenta");

    Swal.fire({
        title: 'Estas seguro de borrar la venta?',
        text: "Si o lo esta puede borrar la accion!",
        type: 'warning',//tipo
        showCancelButton: true,//habilitamos para cancelar la accion
        confirmButtonColor: '#3085d6',//color de boton
        cancelButtonColor: '#d33',//color de boto de cancelar
        cancelButtonText: 'Cancelar!',//texto de cancelar 
        confirmButtonText: 'Si, borrar usuario!'//texto de confirmar
      }).then(function(result){
        
        if (result.value) 
        {
            console.log("verdadero");
            // debemos capturar el id de la venta y la ruta de la foto
            //debemos recordar que configuramos el regwrite a RewriteRule ^([-a-zA-Z0-9]+)$ index.php?ruta=$1
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
            
        }

      })

}))










/*==========================================================
                BOTON IMPRIMIR VENTA
============================================================*/
 
$(".tabla").on("click", ".btnImprimirFactura",(function()

{
    var codigoVenta = $(this).attr("codigoVenta");

    // window.open("extensiones/tcpdf/pdf/pdf.php", "_blank");
    // window.open("extensiones/tcpdf/pdf/factura.php");
    window.open("extensiones/tcpdf_min/factura.php?codigo="+codigoVenta, "_blank");

}))








/*==========================================================
                RANGO DE FECHAS
============================================================*/
 
//Date range as a button
$('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Ultimos 7 dias' : [moment().subtract(6, 'days'), moment()],
        'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Ultimo mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
    //   startDate: moment().subtract(29, 'days'),
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        
        var fechaInicial = start.format('YYYY-MM-DD');
        console.log("fechaInicial", fechaInicial);
        
        var fechaFinal = end.format('YYYY-MM-DD');
        console.log("fechaFinal", fechaFinal);

        var capturarRango = $("#daterange-btn span").html();
        console.log("capturarRango : ", capturarRango);

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    }
  )








    /*==========================================================
                CANCELAR RANGO DE FECHAS
    ============================================================*/

    $(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function()
    {
        localStorage.removeItem("capturarRango");
        localStorage.clear();
        window.location = "ventas";
    })







    /*==========================================================
                        CAPTURAR HOY
    ============================================================*/

    $(".daterangepicker.opensleft .ranges li").on("click", function()
    {
        // console.log($(this).attr("data-range-key"));

        var textoHoy = $(this).attr("data-range-key");

        if(textoHoy == "Hoy")
        {
            var d = new Date();
            console.log("fecha hoy : ", d);
            
            var dia = d.getDate();
            console.log("dia de hoy : ", dia);
            var mes = d.getMonth()+1;//en javascript es de 0 a 11, por eso sumamos a 1
            var anio = d.getFullYear();

            // si el mes es menor a 10 vamos a concatenar un 0 delante del nro del mes
            if(mes < 10)
            {
                var fechaInicial = anio+"-0"+mes+"-"+dia;
                var fechaFinal = anio+"-0"+mes+"-"+  dia;
            }
            else if( dia < 10 )
            {
                var fechaInicial = anio+"-"+mes+"-0"+dia;
                var fechaFinal = anio+"-"+mes+"-0"+dia;
            }
            else if( mes < 10 && dia < 10 )
            {
                var fechaInicial = anio+"-0"+mes+"-0"+dia;
                var fechaFinal = anio+"-0"+mes+"-0"+dia;
            }
            else
            {
                var fechaInicial = anio+"-"+mes+"-"+dia;
                var fechaFinal = anio+"-"+mes+"-"+  dia;
            }


            localStorage.setItem("capturarRango", "Hoy");

            window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;


        }
    })












// function verificar(stock)
// {
//     var stock = $(this).prop("stock").val();

    
//     if(stock == 0)
//     {
//         console.log(stock);
//         Swal.fire({
//             title: 'Solo se permiten numeros',
//             type: 'error',//tipo
//             confirmButtonText: 'Cerrar!'//texto de confirmar
//           });

//         return;
//     }
// }








