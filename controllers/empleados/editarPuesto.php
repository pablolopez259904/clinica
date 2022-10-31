<?php
    include '../conexion.php';

	$db_conexionREditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_puesto = utf8_decode($_POST['txt_puesto']);
	
	$sqlUpdate = "UPDATE clinicaproyecto_2021.puestos SET puesto = '".$txt_puesto."' WHERE puestos.id_puesto = $idEdit;";

	if($db_conexionREditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	$db_conexionREditar -> close();
	header("Location: ../../views/empleados/puestos.php");
	ob_end_flush();
    
?>