<?php
    include 'conexion.php';

	$db_conexionUEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_rama = utf8_decode($_POST['txt_rama']);
	
	$sqlUpdate = "UPDATE clinicaproyecto_2021.rama_medica SET rama ='".$txt_rama."' WHERE id_rama_medica = $idEdit;";

	if($db_conexionUEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionUEditar -> close();
	header("Location: ../../views/ramaMedica/ramaMedica.php");
	ob_end_flush();
    
?>