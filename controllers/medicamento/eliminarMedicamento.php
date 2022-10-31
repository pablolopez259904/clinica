
<?php
    include '../conexion.php';

	$db_conexionUEliminar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$id = utf8_decode($_GET["id"]);

	$sqlDelete = "DELETE FROM medicamento  WHERE id_medicamento  = '$id';";
									  
	if($db_conexionUEliminar->query($sqlDelete)==true){
	} else {
		echo 'ERROR AL ELIMINAR REGISTRO';
	}
	$db_conexionUEliminar -> close();
	header("Location: ../../views/medicamento/medicamento.php");
    die();
?>