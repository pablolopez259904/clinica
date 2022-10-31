<?php
//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['administrador'])) 
{ 
            /* nos envía a la siguiente dirección en el caso de no poseer autorización */
			header("location:/proyectos/clinicaProyecto/index.php"); 
    
}

?>
<?php
	ob_start();
	require_once '../../controllers/conexion.php';

	//ROLES
	$db_conexionRoles = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionRoles->real_query("SELECT id_rol as id, rol FROM roles;");
	$resultadoR = $db_conexionRoles->use_result();

?>

<!doctype html>
<html lang="en">

<head>
	<title>Roles de Usuario</title>
	<link rel="shortcut icon" href="imgs/titleUsuarios.png" />

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!--<link rel="stylesheet" type="text/css" href="../Estilo/fondo.css">-->
</head>

<?php include '../cabecera.php'; ?>

<body background="../../imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
    <div class="col-md-8" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Formulario Roles de Usuario</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
			<div class="col">
				<div class="col-md-4">
					<label for="lbl_rol" class="form-label"><b>Rol</b></label>
					<input type="text" name="txt_rol" id="txt_rol" class="form-control" placeholder="Administrador/Gerente/Empleado" required>
				</div>
				<br>

				<div class="row">
					<div class="col-md-6">
						<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar Rol">
					</div>

					<div class="col-md-6" align="right">
						<a href="../usuario/usuarios.php" class="btn btn-success">Regresar a Usuarios</a>
					</div>
				</div>

			</div>
		</form>
		</div>
		<div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de Roles de Usuario</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <table class="table table-striped table-inverse table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th>Nombre del Rol</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>

				<?php
				while ($filaRol = $resultadoR->fetch_assoc()) {
					echo "<tr data-id=" . $filaRol['id'] . ">";
					echo "<td>" . $filaRol['rol'] . "</td>";
					echo "<td><a href='editarRol.php?id=" . $filaRol['id'] . "' class='btn btn-warning'>Editar</a> 
								<a href='../../controllers/rolesUsuario/eliminarRol.php?id=" . $filaRol['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
					echo "</tr>";
				}
				$db_conexionRoles->close();
				?>
			</tbody>
		</table>

	</div>

	<?php
		
		if(isset($_POST["btn_agregar"])){	
			include '../../controllers/rolesUsuario/nuevoRol.php';
		}	

	?>



	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>