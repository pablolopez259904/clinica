<?php
	include '../../controllers/conexion.php';

	$db_conexionUInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
    $txt_nombre = utf8_decode($_POST["txt_nombre"]);
	$txt_serie = utf8_decode($_POST["txt_serie"]);
	$txt_fecha_caducidad=utf8_decode( $_POST["txt_fecha_nacimiento"]);
	

	$sqlInsertUser =  "INSERT INTO clinicaproyecto_2021.lotes_medicina(nombre, serie, fecha_caducidad) 
						VALUES ('".$txt_nombre."', '".$txt_serie."', '".$txt_fecha_caducidad."');";
	
	if($db_conexionUInsert->query($sqlInsertUser)==true){
		$db_conexionUInsert -> close();
		
		header("Location: ../lotesMedicina/lotesMedicina.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertUser ."<br>". $db_conexionUInsert -> close();
	}
?>