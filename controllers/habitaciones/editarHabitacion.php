<?php
    include '../conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_sector = utf8_decode($_POST['txt_sector']);
	$txt_numero = utf8_decode($_POST["txt_numero"]);
	$drop_sucursal = utf8_decode($_POST["drop_sucursal"]);
	
	$sqlUpdate = "UPDATE habitaciones SET id_sucursal = ".$drop_sucursal.", sector = '".$txt_sector."', numero = ".$txt_numero." WHERE id_habitacion = ".$idEdit.";";
	echo"<br><br><br><br>";

	if($db_conexionUEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionUEditar -> close();
	header("Location: ../../views/habitaciones/habitaciones.php");
	ob_end_flush();
    
?>