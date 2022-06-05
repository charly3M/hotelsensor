
    
<?php require_once "vistas/adminpartesup.php"?>

<div class="container">
   <h1>Empleados</h1>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * from empleados";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
       <div class="row">
           <div class="col-lg-12">            
           <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Contratar empleado</button>    
           </div>    
       </div>    
   </div>    
   <br>  
<div class="container">
       <div class="row">
               <div class="col-lg-12">
                   <div class="table-responsive">        
                       <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                       <thead class="text-center">
                           <tr>
                               <th>Id</th> 
                               <th>Nombre</th>  
                               <th>Apellido</th>
                               <th>Ingreso</th>
                               <th>Telefono</th>
                               <th>Area</th>  
                               
                               <th>Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php                            
                           foreach($data as $dat) {                                                        
                           ?>
                           <tr>
                               <td><?php echo $dat['idempleado'] ?></td>
                               <td><?php echo $dat['nombre'] ?></td>
                               <td><?php echo $dat['apellido'] ?></td> 
                               <td><?php echo $dat['ingreso'] ?></td> 
                               <td><?php echo $dat['telefono'] ?></td> 
                               <td><?php echo $dat['area'] ?></td> 
                               
                                  
                               <td></td>
                           </tr>
                           <?php
                               }
                           ?>                                
                       </tbody>        
                      </table>                    
                   </div>
               </div>
       </div>  
   </div>    

   <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
               </button>
           </div>
       <form id="formEmpleados">    
           <div class="modal-body">
               <div class="form-group">
               <label for="nombre" class="col-form-label">Nombre:</label>
               <input type="text" class="form-control" id="nombre">
               </div>
               <div class="form-group">
               <label for="apellido" class="col-form-label">Apellido:</label>
               <input type="text" class="form-control" id="apellido">
               </div>  
               <div class="form-group">
               <label for="ingreso" class="col-form-label">Ingreso:</label>
               <input type="date" class="form-control" id="ingreso">
               </div>                
                                  
               <div class="form-group">
               <label for="telefono" class="col-form-label">Telefono</label>
               <input type="text" class="form-control" id="telefono">
               </div>   

               <div class="form-group">
               <label for="area" class="col-form-label">Area:</label>
               <input type="text" class="form-control" id="area">
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


<?php require_once "vistas/parte_inferior.php"?>

