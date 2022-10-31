<?php
    include '../../controllers/conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_GET["id"]);
	$drop_paciente = utf8_decode($_POST["drop_paciente"]);

    echo "ID_HABITACION: ".$idEdit;
    echo "ID_PACIENTE: ".$drop_paciente;

	$sqlUpdate = "UPDATE habitacion_reservada SET estado = 'Ocupado', id_paciente = '".$drop_paciente."' WHERE id_habitacion = '".$idEdit."';";

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
?>