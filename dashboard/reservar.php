<?php require_once "vistas/parte_superior.php"?>
<!-- <link rel="stylesheet" href="estilos.css"> -->
        
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<div class="container">
    <h1>Reservar Habitacion</h1>
    

 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT idreserva, clientes.nombre, fechaentrada, fechasalida, cantidad, telefono FROM clientes, reservas where
clientes.idcliente=reservas.idcliente ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva Reservación</button>    
            </div>    
        </div>    
    </div>    
    <br>  
  
   <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="domicilio" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="domicilio">
                </div>  
                <div class="form-group">
                <label for="telefono" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control" id="telefono">
                </div>                
                                   
                <div class="form-group">
                <label for="fechaentrada" class="col-form-label">Fecha de entrada</label>
                <input type="date" class="form-control" id="fechaentrada">
                </div>   

                <div class="form-group">
                <label for="fechasalida" class="col-form-label">Fecha de salida:</label>
                <input type="date" class="form-control" id="fechasalida">
                </div>   

                <div class="form-group">
                <label for="tipo" class="col-form-label">Tipo:</label>
                <select id="tipo" name="tipo" class="form-control" >
                <option value="economicapar" selected>EconomicaPar - $900</option>
                <option value="economicacuatro">EconomicaCuatro - $1999</option>
                <option value="suitepar">SuitePar - $3000</option>
                </select>
                </div>                              

                <div class="form-group">
                <label for="cantidad" class="col-form-label">¿Cuántas habitaciones?:</label>
                <input type="number" class="form-control" id="cantidad">
                </div>  
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<script src="https://momentjs.com/downloads/moment.min.js"></script>



<?php require_once "vistas/parte_inferior.php"?>