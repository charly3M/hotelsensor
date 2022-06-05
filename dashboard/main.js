const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
const alert = (message, type) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
      `<div class="alert alert-${type} alert-dismissible" role="alert">`,
      `   <div>${message}</div>`,
      '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
      '</div>'
    ].join('')
  
    alertPlaceholder.append(wrapper)
  }
  
  const alertTrigger = document.getElementById('liveAlertBtn')
  if (alertTrigger) {
    alertTrigger.addEventListener('click', () => {
      alert('Nice, you triggered this alert message!', 'success')
    })
  }
  


$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Datos de reserva");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    console.log(document);


    
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    fechaentrada = fila.find('td:eq(2)').text();
    fechasalida = fila.find('td:eq(3)').text();
    telefono = "";
    domicilio = "";
    tipo="";
    cantidad = fila.find('td:eq(5)').text();
    edad = parseInt(fila.find('td:eq(3)').text());

    
    
    $("#nombre").val(nombre);
    $("#domicilio").val(domicilio);
    $("#telefono").val(telefono);
    $("#fechaentrada").val(fechaentrada);
    $("#fechasalida").val(fechasalida);
    $("#tipo").val(tipo);
    $("#cantidad").val(cantidad);
    


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
               
    
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();   
    
    nombre = $.trim($("#nombre").val());
    console.log(nombre); 

    domicilio = $.trim($("#domicilio").val());
    console.log(domicilio); 

    telefono = $.trim($("#telefono").val());   
    console.log(telefono);  

    fechaentrada = $.trim($("#fechaentrada").val());  
    console.log(fechaentrada); 

    fechasalida = $.trim($("#fechasalida").val());  
    console.log(fechasalida); 
   
    var valor= document.getElementById("tipo").value;
    
    cantidad = $.trim($("#cantidad").val());  
    console.log(cantidad); 

    var fecha1 = moment(fechaentrada);
    var fecha2 = moment(fechasalida);

    
    console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
    
    var diasdif = (fecha2.diff(fecha1, 'days' ));
    
    console.log(diasdif);

    if (valor=="economicapar"){
        tipo="1";
        var costo= (diasdif*900)*cantidad;
    }
    if (valor=="economicacuatro"){
        tipo="2";
        var costo=  (diasdif*1999)*cantidad;
    }
    if (valor=="suitepar"){
        tipo="3";
        var costo=  (diasdif*3000)*cantidad;
    }

    
    console.log("tipo: "+tipo); 

    console.log(costo);
    

    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json", 
        data: {id:id, nombre:nombre, domicilio:domicilio, telefono:telefono, fechaentrada:fechaentrada, fechasalida:fechasalida, tipo:tipo, cantidad:cantidad, costo:costo, opcion:opcion},
        
        success: function(data){  
            console.log(data);
            id = data[0].idreserva;            
            nombre = data[0].nombre;
            telefono = data[0].telefono;
            cantidad= data[0].cantidad;
            tipo = data[0].tipo;
            fechaentrada= data[0].fechaentrada;
            fechasalida= data[0].fechasalida;
            costo= data[0].costo;


            if(opcion == 1){tablaPersonas.row.add([id,nombre,fechaentrada,fechasalida, costo, cantidad]).draw();}
            else{tablaPersonas.row(fila).data([id,nombre,fechaentrada,fechasalida,costo,cantidad]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    


//botón EDITAR empleado    
// $(document).on("click", ".btnEditar", function(){
//     fila = $(this).closest("tr");
//     id = parseInt(fila.find('td:eq(0)').text());
//     nombre = fila.find('td:eq(1)').text();
//     apellido = fila.find('td:eq(2)').text();
//     ingreso = fila.find('td:eq(3)').text();
//     telefono = fila.find('td:eq(4)').text();
//     area = fila.find('td:eq(5)').text();

    
//     //edad = parseInt(fila.find('td:eq(3)').text());
    
//     $("#nombre").val(nombre);
//     $("#apellido").val(apellido);
//     $("#ingreso").val(ingreso);
//     $("#telefono").val(telefono);
//     $("#area").val(area);
    


//     opcion = 2; //editar
    
//     $(".modal-header").css("background-color", "#4e73df");
//     $(".modal-header").css("color", "white");
//     $(".modal-title").text("Editar Persona");            
//     $("#modalCRUD").modal("show");  
    
// });


 
$("#formEmpleados").submit(function(e){
    e.preventDefault();   
    
    nombre = $.trim($("#nombre").val());
    console.log(nombre); 

    apellido = $.trim($("#apellido").val());
    console.log(apellido); 

    ingreso = $.trim($("#ingreso").val());   
    console.log(ingreso);  

    telefono = $.trim($("#telefono").val());  
    console.log(telefono); 

    area= $.trim($("#area").val());  
    console.log(area); 

    console.log(opcion);


    $.ajax({
        url: "bd/crudempleados.php",
        type: "POST",
        dataType: "json", 
        data: {id:id, nombre:nombre, apellido:apellido, ingreso:ingreso, telefono:telefono, area:area, opcion:opcion},
        
        success: function(data){  
            
            id = data[0].idempleado;            
            nombre = data[0].nombre;
            apellido= data[0].apellido;
            ingreso= data[0].ingreso;
            telefono = data[0].telefono;
            area= data[0].area;
           

            if(opcion == 1){tablaPersonas.row.add([id,nombre,apellido,ingreso, telefono, area]).draw();}
            else{tablaPersonas.row(fila).data([id,nombre,apellido,ingreso, telefono, area]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});
    
});