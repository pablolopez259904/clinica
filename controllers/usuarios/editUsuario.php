<?php
    include '../conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_email = utf8_decode($_POST['txt_email']);
	$txt_nombres = utf8_decode($_POST["txt_nombres"]);
	$txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
	$txt_password = utf8_decode($_POST["txt_password"]);
	$drop_rol = utf8_decode($_POST["drop_rol"]);
	
	$sqlUpdate = "UPDATE clinicaproyecto_2021.usuarios SET email = '".$txt_email."', nombres = '".$txt_nombres."', 
				apellidos = '".$txt_apellidos."', password = '".$txt_password."', id_rol = $drop_rol  WHERE usuarios.id_usuario = $idEdit;";

	echo"<br><br><br><br>";
	if($db_conexionUEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionUEditar -> close();
	header("Location: ../usuario/usuarios.php");
	ob_end_flush();
    
?>