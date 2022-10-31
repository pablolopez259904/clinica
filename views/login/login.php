
<?php

require_once 'controllers/conexion.php';

$db_conexionLogin = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);

if (!$db_conexionLogin) 
{
	die("No hay conexión: ".mysqli_connect_error());
}

$email = utf8_decode($_POST["email"]);
$password = utf8_decode($_POST["password"]);

$query = mysqli_query($db_conexionLogin, "SELECT email, password FROM clinicaproyecto_2021.usuarios WHERE email = '".$email."' AND password = '".$password."' AND id_rol ='1';");
$resultadoL = mysqli_num_rows($query);

$query2 = mysqli_query($db_conexionLogin, "SELECT email, password FROM clinicaproyecto_2021.usuarios WHERE email = '".$email."' AND password = '".$password."';");
$resultadoLL = mysqli_num_rows($query2);

if($resultadoL > 0)
{	

		session_start();
	
		
		$_SESSION['administrador']="$usuario";
		//echo "<script> alert('va a ingresar con administrador');window.location= 'index.php'</script>";
		header("Location: views/inicio.php");

		exit(); 

	
}

if($resultadoLL > 0)
{	

		session_start();
	
		$_SESSION['usuario']="$usuario";
		//echo "<script> alert('va a ingresar con usuario');window.location= 'index.php'</script>";
		
		header("Location: views/inicio.php");
		exit(); 


}
else
{
	echo "<script> alert('Usuario no existe');window.location= 'index.php'</script>";
}

?>
