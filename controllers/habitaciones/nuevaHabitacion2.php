<?php
	//ob_start();
	include '../../controllers/conexion.php';

	$db_conexionUInsert2 = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	$dbconexion2 = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);

	$db_conexionUInsert2 -> real_query("SELECT MAX(id_habitacion) AS id_habitacion FROM habitaciones;");
	$resultado = $db_conexionUInsert2 -> use_result();
	$nueva = $resultado->fetch_assoc();

	             //INSERT INTO clinicaproyecto_2021.habitacion_reservada(id_habitacion,estado) VALUES ('11','Libre');
	$sqlInserHR = "INSERT INTO clinicaproyecto_2021.habitacion_reservada(id_habitacion,estado) VALUES ('".$nueva['id_habitacion']."','Libre');";
	
	if($dbconexion2->query($sqlInserHR)==true){
		echo "REGISTRO EXITOSO ";
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInserHR;
	}
	$db_conexionUInsert2 -> close();
	$dbconexion2 -> close();
	header("Location: ../../views/habitaciones/habitaciones.php");
	ob_end_flush();
?>