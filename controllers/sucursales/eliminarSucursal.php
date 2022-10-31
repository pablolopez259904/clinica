<?php
    include '../conexion.php';
	$db_conexionUEliminar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);	
	$id = utf8_decode($_GET["id"]);

	$sqlDelete = "DELETE FROM sucursales WHERE id_sucursal = ". $id .";";
									  
	if($db_conexionUEliminar->query($sqlDelete)==true){
	} else {
		echo 'ERROR AL ELIMINAR REGISTRO';
	}
	$db_conexionUEliminar -> close();
	header("Location: ../../views/sucursales/sucursales.php");
    die();
?>