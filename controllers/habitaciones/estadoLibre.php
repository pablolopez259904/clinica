<?php
    include '../conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$id = utf8_decode($_GET["id"]);
	
	$sqlUpdate = "UPDATE habitacion_reservada SET id_paciente = NULL, estado = 'Libre' WHERE id_habitacion = $id ;";
    
	if($db_conexionUEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionUEditar -> close();
	header("Location: ../../views/habitaciones/habitacionesOcupadas.php");
	ob_end_flush();
    
    echo "VER: ".$sqlUpdate;
?>