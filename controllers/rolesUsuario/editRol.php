<?php
    include 'conexion.php';

	$db_conexionREditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_rol = utf8_decode($_POST['txt_rol']);
	
	$sqlUpdate = "UPDATE clinicaproyecto_2021.roles SET rol = '".$txt_rol."' WHERE roles.id_rol = $idEdit;";

	echo"<br><br><br><br>";
	if($db_conexionREditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionREditar -> close();
	header("Location: ../../views/roles/roles.php");
	ob_end_flush();
    
?>