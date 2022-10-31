<?php
    include ("../conexion.php");
	$db_conexionEliminar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	$idCita = utf8_decode($_GET["id"]);


	//$consultaPacientes = "SELECT id_paciente FROM detalle_citas WHERE id_cita = ".$idCita.";";
	//$resultadoPacientes = mysqli_query($db_conexionEliminar, $consultaPacientes);

	//if($resultadoPacientes){
	//	$filaPacientes = $resultadoPacientes -> fetch_array(); 
	//	$idPaciente = $filaPacientes['id_paciente'];
	//}

	//DELETE DETALLE CITAS
	$sqlDeleteDetalleCitas = "DELETE FROM detalle_citas WHERE id_cita = ".$idCita.";";

	//DELETE CITAS
	$sqlDeleteCitas = "DELETE FROM citas WHERE id_cita = ".$idCita.";";
	
	//DELETE PACIENTES
	//$sqlDeletePacientes = "DELETE FROM pacientes WHERE id_paciente = ".$idPaciente.";";
	
	if($db_conexionEliminar -> query($sqlDeleteDetalleCitas) == true){
		if($db_conexionEliminar -> query($sqlDeleteCitas) == true){
				header("Location: ../../views/citas/citas.php");
				die();	
		}else{
			echo"ERROR EN EL REGISTRO: ". $sqlDeleteCitas ."<br>". $db_conexionEliminar -> close();
			$db_conexionEliminar -> close();
		}
	}else{
		echo"ERROR EN EL REGISTRO: ". $sqlDeleteDetalleCitas ."<br>". $db_conexionEliminar -> close();
        $db_conexionEliminar -> close();
	}
?>