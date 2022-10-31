<?php
    include '../conexion.php';

	$db_conexionUEliminar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$id = utf8_decode($_GET["id"]);

	$sqlDelete1 = "DELETE FROM habitacion_reservada WHERE habitacion_reservada.id_habitacion = '$id'";
	$sqlDelete = "DELETE FROM habitaciones WHERE id_habitacion = '$id';";
									  
	if($db_conexionUEliminar->query($sqlDelete1)==true){

		if($db_conexionUEliminar->query($sqlDelete)==true){

		}else{
			echo 'ERROR AL ELIMINAR REGISTRO DE NORMAL';	
		}
	} else {
		echo 'ERROR AL ELIMINAR REGISTRO DE RESERVADA';
	}
	$db_conexionUEliminar -> close();
	header("Location: ../../views/habitaciones/habitaciones.php");
    die();
?>