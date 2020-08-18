/*=============================================
                SideBar Menu
=============================================*/

$('.sidebar-menu').tree();









/*=============================================
                DATATABLES
=============================================*/

 $('.tabla').DataTable(
   {
    "language": 
    {

            "sProcessing":     "Procesando...",
            
            "sLengthMenu":     "Mostrar _MENU_ registros",
            
            "sZeroRecords":    "No se encontraron resultados",
            
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            
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
   }
  });



//  $(document).ready(function () {

//     $('.tab').DataTable();
// });




/*=============================================
                ICHECK
=============================================*/
 //iCheck for checkbox and radio inputs
 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })




/*=============================================
                INPUTMASK
=============================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask();





/*=============================================
                SELECT2
=============================================*/
$('.select2').select2();





function format(input)
{
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
    num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    num = num.split('').reverse().join('').replace(/^[\.]/,'');
    input.value = num;
    }
    
    // else{ alert('Solo se permiten numeros');
    // input.value = input.value.replace(/[^\d\.]*/g,'');
    // }
    
    
    else
    {
      // alert('Solo se permiten numeros');
      Swal.fire({
        title: 'Solo se permiten numeros',
        type: 'error',//tipo
        confirmButtonText: 'Cerrar!'//texto de confirmar
      });
      input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}
