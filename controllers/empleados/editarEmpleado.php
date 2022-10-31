<?php
    include '../conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_codigo = utf8_decode($_POST['txt_codigo']);
	$txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_direccion = utf8_decode($_POST["txt_direccion"]);
	$txt_telefono = utf8_decode($_POST["txt_telefono"]);
	$txt_fecha = utf8_decode($_POST["txt_fecha"]);
    $drop_puesto = utf8_decode($_POST["drop_puesto"]);
	
	$sqlUpdate = "UPDATE clinicaproyecto_2021.empleados SET codigo = '".$txt_codigo."', nombres = '".$txt_nombres."', 
				apellidos = '".$txt_apellidos."', direccion = '".$txt_direccion."', telefono = '".$txt_telefono."', fecha_nacimiento = '".$txt_fecha."', id_puesto = $drop_puesto  WHERE empleados.id_empleado = $idEdit;";

	echo"<br><br><br><br>";
	if($db_conexionUEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionUEditar -> close();
	header("Location: ../../views/empleados/personas.php");
	ob_end_flush();
    
?>