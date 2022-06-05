   
<?php require_once "vistas/adminpartesup.php"?>

<div class="container">
   <h1>Incidencias</h1>
   <h2>Registro de alertas de humo y gas en el hotel</h2>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM incidencias";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


   
   <br>  
<div class="container">
       <div class="row">
               <div class="col-lg-12">
                   <div class="table-responsive">        
                       <table id="tablaIncidencias" class="table table-striped table-bordered table-condensed" style="width:100%">
                       <thead class="text-center">
                           <tr>
                               <th>Id</th> 
                               <th>Fecha</th>
                               <th>Valor</th>
                               <th>Habitacion</th>
                               

                             <th></th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php                            
                           foreach($data as $dat) {                                                        
                           ?>
                           <tr>
                               <td><?php echo $dat['id'] ?></td>
                               <td><?php echo $dat['fecha'] ?></td>
                            
                               <td><?php echo $dat['valor'] ?></td> 
                               <td><?php echo $dat['idhabitacion'] ?></td>
                             
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


  

<?php require_once "vistas/parte_inferior.php"?>

<script src="main.js"></script>