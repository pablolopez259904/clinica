<?php
    include '../conexion.php';

	$db_conexionEdit= mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
    $txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_fecha_nacimiento = utf8_decode($_POST["txt_fecha_nacimiento"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_correo = utf8_decode($_POST["txt_correo"]);
	$drop_Medicamento = utf8_decode($_POST["drop_Medicamento"]);
	
	$sqlUpdate = "UPDATE clinicaproyecto_2021.pacientes SET nombres = '".$txt_nombres."', apellidos = '".$txt_apellidos."', 
	fecha_nacimiento = '".$txt_fecha_nacimiento."', telefono = '".$txt_telefono."', direccion = '".$txt_direccion."', correo_electronico = '".$txt_correo."', id_medicamento = $drop_Medicamento  WHERE pacientes.id_paciente = $idEdit;";

	echo"<br><br><br><br>";
	if($db_conexionEdit->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionEdit -> close();
	header("Location: ../../views/paciente/paciente.php");
    
	ob_end_flush();
    
?>