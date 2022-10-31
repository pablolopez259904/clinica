<?php
	include '../conexion.php';

	$db_conexionUInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
    $txt_email = utf8_decode($_POST["txt_email"]);
	$txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_password = utf8_decode($_POST["txt_password"]);
	$drop_rol = utf8_decode($_POST["drop_rol"]);

	$sqlInsertUser =  "INSERT INTO clinicaproyecto_2021.usuarios(email, nombres, apellidos, password, id_rol) 
						VALUES ('".$txt_email."', '".$txt_nombres."', '".$txt_apellidos."', '".$txt_password."', '".$drop_rol."')";
	
	if($db_conexionUInsert->query($sqlInsertUser)==true){
		$db_conexionUInsert -> close();
		
		header("Location: ../usuario/usuarios.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertUser ."<br>". $db_conexionUInsert -> close();
	}
?>