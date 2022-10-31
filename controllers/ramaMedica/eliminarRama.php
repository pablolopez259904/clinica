<?php
    include '../conexion.php';

	$db_conexionREliminar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$id = utf8_decode($_GET["id"]);

	$sqlDelete = "DELETE FROM clinicaproyecto_2021.rama_medica WHERE id_rama_medica = '$id';";
    
	if($db_conexionREliminar->query($sqlDelete)==true){
		/* */
	} else {
		echo 'ERROR AL ELIMINAR REGISTRO';
	}
	$db_conexionREliminar -> close();
	header("Location: ../../views/ramaMedica/ramaMedica.php");
    die();
?>