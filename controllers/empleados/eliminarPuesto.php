<?php
    include '../conexion.php';

	$db_conexionREliminar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$id = utf8_decode($_GET["id"]);

	$sqlDelete = "DELETE FROM puestos WHERE id_puesto = '$id';";
    
	if($db_conexionREliminar->query($sqlDelete)==true){
	} else {
		echo 'ERROR AL ELIMINAR REGISTRO';
	}
	$db_conexionREliminar -> close();
	header("Location: ../../views/empleados/puestos.php");
    die();
