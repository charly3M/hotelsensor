   
<?php require_once "vistas/adminpartesup.php"?>

<div class="container">
   <h1>Clientes</h1>
   <h2>Datos de los clientes que han realizado reservas en el hotel</h2>
</div>

<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM clientes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


   
   <br>  
<div class="container">
       <div class="row">
               <div class="col-lg-12">
                   <div class="table-responsive">        
                       <table class="table table-striped table-bordered table-condensed" style="width:100%">
                       <thead class="text-center">
                           <tr>
                               <th>Id</th> 
                               <th>Nombre</th>  
                               <th>Domicilio</th>
                               <th>Telefono</th>
                             <th></th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php                            
                           foreach($data as $dat) {                                                        
                           ?>
                           <tr>
                               <td><?php echo $dat['idcliente'] ?></td>
                               <td><?php echo $dat['nombre'] ?></td>
                               <td><?php echo $dat['domicilio'] ?></td> 
                               <td><?php echo $dat['telefono'] ?></td> 
                             
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

