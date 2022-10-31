<?php
	//ob_start();
	include '../../controllers/conexion.php';

	$db_conexionUInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
    $drop_sucursal = utf8_decode($_POST['drop_sucursal']);
	$txt_sector = utf8_decode($_POST["txt_sector"]);
	$txt_numero = utf8_decode($_POST["txt_numero"]);
	
	$sqlInsertUser =  "INSERT INTO habitaciones (id_sucursal, sector, numero) VALUES (". $drop_sucursal .", '". $txt_sector ."', ". $txt_numero .");";

	if($db_conexionUInsert->query($sqlInsertUser)==true){
		echo "REGISTRO EXITOSO ";
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertUser;
	}
	$db_conexionUInsert -> close();
	header("Location: ../../views/habitaciones/habitaciones.php");
	ob_end_flush();
?>