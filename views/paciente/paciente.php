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


	//PACIENTES MEDICADOS
	$db_conexionPaciente = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionPaciente->real_query("SELECT p.id_paciente as id, p.nombres,p.apellidos, p.fecha_nacimiento, p.telefono, p.direccion, p.correo_electronico, m.nombre AS nombreMedicamento FROM clinicaproyecto_2021.pacientes AS p INNER JOIN clinicaproyecto_2021.medicamento AS m ON p.id_medicamento = m.id_medicamento ORDER BY p.nombres;");
	$resultadoP = $db_conexionPaciente->use_result();

	//PACIENTES SIN MEDICAR
	$db_conexionPacienteS = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionPacienteS->real_query("SELECT p.id_paciente as id, p.nombres,p.apellidos, p.fecha_nacimiento, p.telefono, p.direccion, p.correo_electronico FROM clinicaproyecto_2021.pacientes AS p WHERE id_medicamento IS NULL ORDER BY p.nombres;");
	$resultadoPS = $db_conexionPacienteS->use_result();

	//MEDICAMENTOS
	$db_conexionMedicamento = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionMedicamento->real_query("SELECT id_medicamento AS id, nombre AS nombreMedicamento FROM clinicaproyecto_2021.medicamento;");
	$resultadoM = $db_conexionMedicamento->use_result();

?>

<!doctype html>
<html lang="en">

<head>
	<title>PACIENTES</title>
	<link rel="shortcut icon" href="imgs/titleUsuarios.png" />

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!--<link rel="stylesheet" type="text/css" href="../Estilo/fondo.css">-->
</head>

<?php include '../cabecera.php'; ?>

<body background="../imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
	<div class="col-md-8" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h1 class="text-center">Formulario Paciente</h1>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">

		<div class="container">
		<form class="d-flex" action="" method="POST">
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
				<div class="row" style="margin-top: 1em;">
					<div class="col-md-6">
						<label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
						<input type="date" name="txt_fecha_nacimiento" id="txt_fecha_nacimiento" class="form-control" placeholder="dd/mm/aaaa" required>
					</div>
					<div class="col-md-6">
						<label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
						<input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="12345678" required>
					</div>
				</div>
				<div class="row" style="margin-top: 1em;">
					<div class="col-md-6">
						<label for="lbl_Medicamento" class="form-label"><b>Medicamento</b></label>
						<select class="form-select" name="drop_Medicamento" id="drop_Medicamento" required>
							<option value=0>--- Medicamento ---</option>

							<?php
							while ($filaMedicamento = $resultadoM->fetch_assoc()) {
								echo "<option value=" . $filaMedicamento['id'] . ">" . $filaMedicamento['nombreMedicamento'] . "</option>";
							}
							$db_conexionMedicamento->close();
							?>

						</select>
					</div>
					<div class="col-md-6">
						<label for="lbl_correo" class="form-label"><b>Correo Electronico</b></label>
						<input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="desarrolloweb@gmail.com" required>
					</div>
				</div>
				<div class="row" style="margin-top: 1em;">
					<div class="col-md-12">
						<label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
						<input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Calle/Avenida/Lugar/#Casa" required>
					</div>
				</div>					
				<br>
				<div class="text-center" style="margin-top: 1em;">
						<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
				</div>
			</div>
		</form>
		</div>
	</div>
		<div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
			<A name="PM"><h3 class="text-center">Pacientes Medicados</h3></A>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
			<A href="#PPM" class="btn btn-success">Pacientes Por Medicar</A>
            <table class="table table-striped table-inverse table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>FechaNacimiento</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Correo </th>
					<th>Medicamento</th>
					<th>Historial Medico</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($filaPaciente = $resultadoP->fetch_assoc()) {
					echo "<tr data-id=" . $filaPaciente['id'] . ">";
					echo "<td>" . $filaPaciente['nombres'] . "</td>";
					echo "<td>" . $filaPaciente['apellidos'] . "</td>";
					echo "<td>" . $filaPaciente['fecha_nacimiento'] . "</td>";
					echo "<td>" . $filaPaciente['telefono'] . "</td>";
					echo "<td>" . $filaPaciente['direccion'] . "</td>";
					echo "<td>" . $filaPaciente['correo_electronico'] . "</td>";
					echo "<td>" . $filaPaciente['nombreMedicamento'] . "</td>";
					echo "<td><a href='../historialMedico/historialMedico.php?id=" . $filaPaciente['id'] . "' class='btn btn-info btn-sm'>Historial Medico</a></td> ";
					echo "<td><a href='editarPaciente.php?id=" . $filaPaciente['id'] . "' class='btn btn-warning'>Editar</a> 
    							<a href='../../controllers/paciente/eliminarPacienteM.php?id=" . $filaPaciente['id'] . "' class='btn btn-danger'>Eliminar Historial</a></td>";
					echo "</tr>";
				}
				$db_conexionPaciente->close();
				?>
			</tbody>
			</table>
		</div>
		<div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
		<A name="PPM"><h3 class="text-center">Pacientes por Medicar</h3></A>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
			<A href="#PM" class="btn btn-success">Pacientes Medicados</A>
            <table class="table table-striped table-inverse table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>FechaNacimiento</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Correo </th>
					<th>Medicamento</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($filaPacienteS = $resultadoPS->fetch_assoc()) {
					echo "<tr data-id=" . $filaPacienteS['id'] . ">";
					echo "<td>" . $filaPacienteS['nombres'] . "</td>";
					echo "<td>" . $filaPacienteS['apellidos'] . "</td>";
					echo "<td>" . $filaPacienteS['fecha_nacimiento'] . "</td>";
					echo "<td>" . $filaPacienteS['telefono'] . "</td>";
					echo "<td>" . $filaPacienteS['direccion'] . "</td>";
					echo "<td>" . $filaPacienteS['correo_electronico'] . "</td>";
					echo "<td> <a href='agregarMedicamento.php?id=" . $filaPacienteS['id'] . "' class='btn btn-success'>Agregar Medicamento</a> </td>";
					echo "<td><a href='editarPacienteSM.php?id=" . $filaPacienteS['id'] . "' class='btn btn-warning'>Editar</a> 
    							<a href='../../controllers/paciente/eliminarPaciente.php?id=" . $filaPacienteS['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
					echo "</tr>";
				}
				$db_conexionPacienteS->close();
				?>
			</tbody>
			</table>
		</div>

	<?php
		
		if(isset($_POST["btn_agregar"])){	
			include '..\..\controllers\paciente\nuevoPaciente.php';
		}	

	?>



	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>