<?php
	include ("../conexion.php");
	//include '../conexion.php';

	$db_conexionCEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	date_default_timezone_set('Etc/GMT-6');

	//PACIENTE
	$txt_idPaciente = utf8_decode($_POST['txt_idPaciente']);
    $txt_nombres = utf8_decode($_POST['txt_nombres']);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
    $txt_fn = utf8_decode($_POST["txt_fn"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_email = utf8_decode($_POST["txt_email"]);

	//CITAS
	$txt_idCita = utf8_decode($_POST['txt_idCita']);
	$drop_rama = utf8_decode($_POST['drop_rama']);
    $txt_id_medico = utf8_decode($_POST['txt_id_medico']);
    $txt_sintomas = utf8_decode($_POST['txt_sintomas']);
    $txt_fecha_hora = utf8_decode($_POST['txt_fecha_hora']);    //Referencia para el campo
    $fecha_convertida = str_replace("T", " ", $txt_fecha_hora); //Se reemplaza la T por espacio

	//DETALLE CITAS
	$drop_sucusal = utf8_decode($_POST['drop_sucursal']);

	//UPDATE PACIENTE
	$sqlUpdatePaciente = "UPDATE pacientes SET nombres = '".$txt_nombres."', apellidos = '".$txt_apellidos."', fecha_nacimiento = '".$txt_fn."', telefono = '".$txt_telefono."', direccion = '".$txt_direccion."', correo_electronico = '".$txt_email."' WHERE id_paciente = ".$txt_idPaciente.";";

	//UPDATE CITAS
	$sqlUpdateCitas = "UPDATE citas SET id_rama_medica = ".$drop_rama." , id_empleado = ".$txt_id_medico.", sintomas = '".$txt_sintomas."', fecha_hora = '".$txt_fecha_hora."' WHERE id_cita = ".$txt_idCita.";";

	//UPDATE DETALLE CITAS
	$sqlUpdateDetalleCitas = "UPDATE detalle_citas SET id_sucursal = ".$drop_sucusal." WHERE id_cita = ".$txt_idCita.";";
	
	
	if($db_conexionCEditar -> query($sqlUpdatePaciente) == true){
		if($db_conexionCEditar -> query($sqlUpdateCitas) == true){
			if($db_conexionCEditar -> query($sqlUpdateDetalleCitas) == true){
				$db_conexionCEditar -> close();
                header("Location: ../../views/citas/citas.php");
		        ob_end_flush();
			}else{
				echo"ERROR EN EL REGISTRO: ". $sqlUpdateDetalleCitas ."<br>". $db_conexionCEditar -> close();
                $db_conexionCEditar -> close();
			}
		}else{
			echo"ERROR EN EL REGISTRO: ". $sqlUpdateCitas ."<br>". $db_conexionCEditar -> close();
                $db_conexionCEditar -> close();
		}
	}else{
		echo"ERROR EN EL REGISTRO: ". $sqlUpdatePaciente ."<br>". $db_conexionCEditar -> close();
        $db_conexionCEditar -> close();
	}
?>