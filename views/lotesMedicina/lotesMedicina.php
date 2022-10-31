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
	$db_conexionUsuarios->real_query("SELECT * FROM clinicaproyecto_2021.lotes_medicina;");
	$resultadoU = $db_conexionUsuarios->use_result();


?>

<!doctype html>
<html lang="en">

<head>
	<title>Lotes Medicamento</title>
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
    <div class="col-md-8" style="margin-left: 50px; margin-top: 1em;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Formulario Lotes Medicamento</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
						<label for="lbl_nombre" class="form-label"><b>Nombre</b></label>
						<input type="text" name="txt_nombre" id="txt_nombre" class="form-control" placeholder="Nombre del lote" required>
					</div>

					<div class="col-md-6">
						<label for="lbl_serie" class="form-label"><b>Serie</b></label>
						<input type="text" name="txt_serie" id="txt_serie" class="form-control" placeholder="Numero de serie: LM-001" required>
					</div>
				</div>
				<div class="row" style="margin-top: 1em;">
					<div class="col-md-6">
						<label for="lbl_fn" class="form-label"><b>Fecha de Caducidad</b></label>
						<input type="date" name="txt_fecha_nacimiento" id="txt_fecha_nacimiento" class="form-control" placeholder="dd/mm/aaaa" required>
					</div>
				</div>
				<div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                    <?php
                   		if (isset($_POST["btn_agregar"])) {
							include '../../controllers/lotesMedicina/nuevoLote.php';
						}
                    ?>
                    <a href="../../views/medicamento/medicamento.php"><input class="btn btn-success" value="Regresar a Medicamento"></a>
                </div>
			</form>
        </div>
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de Lotes Medicamento</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                    <table class="table table-striped table-inverse table-responsive">
						<thead class="thead-inverse">
							<tr>
								<th>Nombre</th>
								<th>Serie</th>
								<th>Fecha Caducidad</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($filaUsuario = $resultadoU->fetch_assoc()) {
								echo "<tr data-id=" . $filaUsuario['id_lote_medicina'] . ">";
								echo "<td>" . $filaUsuario['nombre'] . "</td>";
								echo "<td>" . $filaUsuario['serie'] . "</td>";
								echo "<td>" . $filaUsuario['fecha_caducidad'] . "</td>";
								echo "<td><a href='editarLote.php?id=" . $filaUsuario['id_lote_medicina'] . "' class='btn btn-warning'>Editar</a> 
										<a href='../../controllers/lotesMedicina/eliminarLote.php?id=" . $filaUsuario['id_lote_medicina'] . "' class='btn btn-danger'>Eliminar</a></td>";
								echo "</tr>";
							}
							$db_conexionUsuarios->close();
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>