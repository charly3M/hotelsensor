<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';

$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$ingreso = (isset($_POST['ingreso'])) ? $_POST['ingreso'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';




switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO empleados (nombre, apellido, ingreso, telefono, area) VALUES ('$nombre', '$apellido', '$ingreso', '$telefono', '$area')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM empleados ORDER BY idempleado DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', ingreso='$ingreso' , telefono='$telefono', area='$area' WHERE idempleado='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        
        
        $consulta = "SELECT * FROM empleados WHERE idempleado='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM reservas WHERE idreserva='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                         
        
        $consulta = "ALTER TABLE reservas AUTO_INCREMENT = $idultimo";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        
        $consulta = "DELETE FROM clientes WHERE idcliente='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                         
        
        
        $consulta = "ALTER TABLE clientes AUTO_INCREMENT = $idultimo";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        break;    
        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
