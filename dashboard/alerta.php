<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


date_default_timezone_set("America/Mexico_City");

$valor = $_GET['data1'];
$hoy = date('Y-m-d G:i:s');
$id = "";



$consulta = "INSERT INTO `incidencias` (`id`, `fecha`, `valor`, `idhabitacion`) VALUES (NULL, '$hoy', '$valor', '1');";	
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 

$consulta = "SELECT * FROM incidencias ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       

if ($resultado) {
	echo json_encode("OK");
}else{
	echo json_encode("Error en la consulta");
}
?>











