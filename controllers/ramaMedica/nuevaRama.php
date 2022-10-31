<?php
	include 'conexion.php';
	$db_conexionRInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
    
	$txt_rama = utf8_decode($_POST["txt_rama"]);

	$sqlInsertRama =  "INSERT INTO clinicaproyecto_2021.rama_medica(rama) 
						VALUES ('".$txt_rama."')";
	
	if($db_conexionRInsert->query($sqlInsertRama)==true){
		$db_conexionRInsert -> close();
		
		header("Location: ../../views/ramaMedica/ramaMedica.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsertRama ."<br>". $db_conexionRInsert -> close();
	}
?>