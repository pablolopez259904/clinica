<?php
	include '../conexion.php';

	$db_conexionRInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
    $txt_puesto = utf8_decode($_POST["txt_puesto"]);

	$sqlInsertPuesto =  "INSERT INTO clinicaproyecto_2021.puestos(puesto) VALUES ('".$txt_puesto."');";
	
	if($db_conexionRInsert->query($sqlInsertPuesto)==true){
		$db_conexionRInsert -> close();
		
		header("Location: ../../views/empleados/puestos.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertPuesto ."<br>". $db_conexionRInsert -> close();
	}
?>