<?php 
    include ("../conexion.php");
    //$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);

	$db_conexionPCInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	date_default_timezone_set('Etc/GMT-6');

    //PACIENTE
    $txt_nombres = utf8_decode($_POST['txt_nombres']);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
    $txt_fn = utf8_decode($_POST["txt_fn"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_email = utf8_decode($_POST["txt_email"]);
	
    //CITA
    $drop_rama = utf8_decode($_POST['drop_rama']);
    $txt_id_medico = utf8_decode($_POST['txt_id_medico']);
    $txt_sintomas = utf8_decode($_POST['txt_sintomas']);
    $txt_fecha_hora = utf8_decode($_POST['txt_fecha_hora']);    //Referencia para el campo
    $fecha_convertida = str_replace("T", " ", $txt_fecha_hora); //Se reemplaza la T por espacio

    //DETALLE_CITAS
    $drop_sucursal = utf8_decode($_POST['drop_sucursal']);
    

	//INSERT PACIENTES
	$sqlInsertPaciente =  "INSERT INTO clinicaproyecto_2021.pacientes(nombres,apellidos,fecha_nacimiento,telefono,direccion,correo_electronico) 
                            VALUES ('".$txt_nombres."','".$txt_apellidos."','".$txt_fn."','".$txt_telefono."','".$txt_direccion."','".$txt_email."')";

    //INSERT CITAS
    $sqlInsertCita =  "INSERT INTO clinicaproyecto_2021.citas(id_rama_medica,id_empleado,sintomas,fecha_hora) 
                        VALUES (".$drop_rama.",".$txt_id_medico.",'".$txt_sintomas."','".$fecha_convertida."')";
  
    
    
    if($db_conexionPCInsert->query($sqlInsertPaciente)==true){
        if($db_conexionPCInsert->query($sqlInsertCita)==true){
            
            //DETALLE CITAS
            $consultaPacientes = "SELECT id_paciente AS id FROM clinicaproyecto_2021.pacientes ORDER BY id_paciente DESC LIMIT 0, 1;";    
            $consultaCitas = "SELECT id_cita AS id FROM clinicaproyecto_2021.citas ORDER BY id_cita DESC LIMIT 0, 1;";
            $resultadoPacientes = mysqli_query($db_conexionPCInsert, $consultaPacientes);
            $resultadoCitas = mysqli_query($db_conexionPCInsert, $consultaCitas);

            if($resultadoPacientes){
                $filaPacientes = $resultadoPacientes -> fetch_array(); 
                $idPaciente = $filaPacientes['id'];
            }

            if($resultadoCitas){
                $filaCitas = $resultadoCitas -> fetch_array();
                $idCita = $filaCitas['id'];
            }
            
            //INSERT DETALLE_CITAS
            $sqlInsertDetalleCitas = "INSERT INTO detalle_citas (id_sucursal, id_paciente, id_cita, id_usuario) VALUES (".$drop_sucursal.", ".$idPaciente.", ".$idCita.",5);";
    
            if($db_conexionPCInsert -> query($sqlInsertDetalleCitas) == true){
                $db_conexionPCInsert -> close();
                header("Location: ../../views/citas/citas.php");
		        ob_end_flush();
            }else{
                echo"ERROR EN EL REGISTRO: ". $sqlInsertDetalleCitas ."<br>". $db_conexionPCInsert -> close();
                $db_conexionPCInsert -> close();    
            }
    
    
        }else{
            echo"ERROR EN EL REGISTRO: ". $sqlInsertCita ."<br>". $db_conexionPCInsert -> close();
            $db_conexionPCInsert -> close();
        }
        echo"ERROR EN EL REGISTRO: ". $sqlInsertPaciente ."<br>". $db_conexionPCInsert -> close();
        $db_conexionPCInsert -> close();
	}else{
        echo"ERROR EN ALGUN REGISTRO: ". $sqlInsertCita ." O ".$sqlInsertPaciente."<br>". $db_conexionPCInsert -> close();
	}
 
?>