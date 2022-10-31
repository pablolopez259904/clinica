<?php
    include '../conexion.php';
	$db_conexionREditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	$idEdit = utf8_decode($_POST["id"]);
    $txt_nombre = utf8_decode($_POST["txt_nombre"]);
	$txt_direccion = utf8_decode($_POST['txt_direccion']);
	
	$sqlUpdate = "UPDATE sucursales SET nombre = '". $txt_nombre ."', direccion = '". $txt_direccion ."' WHERE id_sucursal = ". $idEdit .";";

	if($db_conexionREditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	$db_conexionREditar -> close();
	header("Location: ../../views/sucursales/sucursales.php");
	ob_end_flush();
    
?>