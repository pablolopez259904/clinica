<?php
	include '../conexion.php';

	$db_conexionUInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
    $txt_codigo = utf8_decode($_POST['txt_codigo']);
	$txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_direccion = utf8_decode($_POST["txt_direccion"]);
	$txt_telefono = utf8_decode($_POST["txt_telefono"]);
	$txt_fecha = utf8_decode($_POST["txt_fecha"]);
    $drop_puesto = utf8_decode($_POST["drop_puesto"]);
	
	$sqlInsertUser =  "INSERT INTO clinicaproyecto_2021.empleados(codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto) 
						VALUES ('".$txt_codigo."', '".$txt_nombres."', '".$txt_apellidos."', '".$txt_direccion."', '".$txt_telefono."', '".$txt_fecha."', '".$drop_puesto."')";
	
	if($db_conexionUInsert->query($sqlInsertUser)==true){
		$db_conexionUInsert -> close();
		
		header("Location: ../../views/empleados/personas.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertUser ."<br>". $db_conexionUInsert -> close();
	}
