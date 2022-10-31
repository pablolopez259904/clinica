<?php
	include '../conexion.php';

	$db_conexionUInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
    $txt_email = utf8_decode($_POST["txt_email"]);
	$txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_password = utf8_decode($_POST["txt_password"]);

	$sqlInsertUser =  "INSERT INTO clinicaproyecto_2021.usuarios(email, nombres, apellidos, password, id_rol) 
						VALUES ('".$txt_email."', '".$txt_nombres."', '".$txt_apellidos."', '".$txt_password."', 4)";
	
	if($db_conexionUInsert->query($sqlInsertUser)==true){
		$db_conexionUInsert -> close();

		header("Location: ./");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertUser ."<br>". $db_conexionUInsert -> close();
	}
?>