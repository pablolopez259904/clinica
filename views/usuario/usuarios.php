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


	//USUARIOS
	$db_conexionUsuarios = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionUsuarios->real_query("SELECT u.id_usuario as id, u.email, u.nombres, u.apellidos, u.password, r.rol FROM clinicaproyecto_2021.usuarios AS u INNER JOIN clinicaproyecto_2021.roles AS r ON u.id_rol = r.id_rol ORDER BY u.nombres;");
	$resultadoU = $db_conexionUsuarios->use_result();

	//ROLES
	$db_conexionRoles = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionRoles->real_query("SELECT id_rol AS id, rol FROM clinicaproyecto_2021.roles;");
	$resultadoR = $db_conexionRoles->use_result();

?>

<!doctype html>
<html lang="en">

<head>
	<title>Usuarios</title>
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
            <h3 class="text-center">Formulario Usuarios</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
			<div class="col">
				<div class="row">
					<div class="col-md-6">
						<label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
						<input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombre1 Nombre2" required>
					</div>

					<div class="col-md-6">
						<label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
						<input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellido1 Apellido2" required>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4">
						<label for="lbl_email" class="form-label"><b>Email</b></label>
						<input type="text" name="txt_email" id="txt_email" class="form-control" placeholder="ejemplo@gmail.com" required>
					</div>

					<div class="col-md-4">
						<label for="lbl_password" class="form-label"><b>Password</b></label>
						<input type="text" name="txt_password" id="txt_password" class="form-control" placeholder="admin.123" required>
					</div>

					<div class="col-md-4">
						<label for="lbl_rol" class="form-label"><b>Rol</b></label>
						<select class="form-select" name="drop_rol" id="drop_rol" required>
							<option value=0>--- Rol de usuario ---</option>

							<?php
							while ($filaRol = $resultadoR->fetch_assoc()) {
								echo "<option value=" . $filaRol['id'] . ">" . $filaRol['rol'] . "</option>";
							}
							$db_conexionRoles->close();
							?>

						</select>
					</div>
				</div>
				<br>

				<div class="text-center" style="margin-top: 1em;">
					<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
					<a href="../roles/roles.php" class="btn btn-success">Administrar Roles de Usuario</a>
				</div>

			</div>
		</form>
		</div>
		<div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de Usuarios</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <table class="table table-striped table-inverse table-responsive">
				<thead class="thead-inverse">
					<tr>
						<th>Email</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Password</th>
						<th>Rol</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

					<?php
					while ($filaUsuario = $resultadoU->fetch_assoc()) {
						echo "<tr data-id=" . $filaUsuario['id'] . ">";
						echo "<td>" . $filaUsuario['email'] . "</td>";
						echo "<td>" . $filaUsuario['nombres'] . "</td>";
						echo "<td>" . $filaUsuario['apellidos'] . "</td>";
						echo "<td>" . $filaUsuario['password'] . "</td>";
						echo "<td>" . $filaUsuario['rol'] . "</td>";
						echo "<td><a href='editarUsuario.php?id=" . $filaUsuario['id'] . "' class='btn btn-warning'>Editar</a> 
											<a href='../../controllers/usuarios/eliminarUsuario.php?id=" . $filaUsuario['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
						echo "</tr>";
					}
					$db_conexionUsuarios->close();
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
		
		if(isset($_POST["btn_agregar"])){	
			include '../../controllers/usuarios/nuevoUsuario.php';
		}	

	?>

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>