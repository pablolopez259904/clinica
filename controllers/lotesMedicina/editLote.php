<?php
    include 'conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_nombre = utf8_decode($_POST["txt_nombre"]);
	$txt_serie = utf8_decode($_POST["txt_serie"]);
	$txt_fecha_caducidad = utf8_decode($_POST["txt_fecha_caducidad"]);

	
	$sqlUpdate = "UPDATE lotes_medicina SET nombre = '".$txt_nombre."', serie = '".$txt_serie."', 	fecha_caducidad = '".$txt_fecha_caducidad."'  WHERE id_lote_medicina = $idEdit;";

	echo"<br><br><br><br>";
	if($db_conexionUEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionUEditar -> close();
	header("Location: ../../views/lotesMedicina/lotesMedicina.php");
	ob_end_flush();
    
?>