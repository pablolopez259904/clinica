<?php
	include '../conexion.php';

	$db_conexionPInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	

	$txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_fecha_nacimiento = utf8_decode($_POST["txt_fecha_nacimiento"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_correo = utf8_decode($_POST["txt_correo"]);
	$drop_Medicamento = utf8_decode($_POST["drop_Medicamento"]);
    $puestoConvertido = str_replace("0", "NULL", $drop_Medicamento); //Se reemplaza si no se escoge puesto

	$sqlInsertPaciente =  "INSERT INTO clinicaproyecto_2021.pacientes(nombres, apellidos, fecha_nacimiento,telefono,direccion ,correo_electronico ,id_medicamento) 
					VALUES ('".$txt_nombres."', '".$txt_apellidos."', '".$txt_fecha_nacimiento."', '".$txt_telefono."', '".$txt_direccion."','".$txt_correo."',  ".$puestoConvertido.")";
	
	if($db_conexionPInsert->query($sqlInsertPaciente)==true){
		$db_conexionPInsert -> close();
		
		header("Location: ../../views/paciente/paciente.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertPaciente ."<br>". $db_conexionPInsert -> close();
	}
?>