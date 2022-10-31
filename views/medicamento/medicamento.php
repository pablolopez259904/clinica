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

$db_conexionMedicamento = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
//;
$db_conexionMedicamento->real_query("SELECT m.id_medicamento AS id,m.nombre,m.marca,m.descripcion,lm.nombre as nombreLote,m.precio_costo,m.precio_venta,m.cantidad FROM clinicaproyecto_2021.medicamento AS m INNER JOIN clinicaproyecto_2021.lotes_medicina AS lm ON m.id_lote_medicina = lm.id_lote_medicina ORDER BY m.nombre;");
$resultadoM = $db_conexionMedicamento->use_result();

$db_conexionId = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionId->real_query("SELECT id_lote_medicina AS id, nombre AS nombreLote FROM clinicaproyecto_2021.lotes_medicina;");
$resultadoR = $db_conexionId->use_result();


?>

<!doctype html>
<html lang="en">

<head>
	<title>Medicamentos</title>
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
            <h3 class="text-center">Formulario Medicamento</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
						<label for="lbl_nombre" class="form-label"><b>Nombre del Medicamento</b></label>
						<input type="text" name="txt_nombre" id="txt_nombre" class="form-control" placeholder="Nombre" required>
					</div>
					<div class="col-md-6">
						<label for="lbl_marca" class="form-label"><b>Marca</b></label>
						<input type="text" name="txt_marca" id="txt_marca" class="form-control" placeholder="Marca" required>
					</div>
				</div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
						<label for="lbl_lote" class="form-label"><b>Lote del Medicamento</b></label>
						<select class="form-select" name="drop_lote" id="drop_lote" required>
							<option value=0>--- lote medicamento ---</option>
							<?php
								while ($filaId = $resultadoR->fetch_assoc()) {
									echo "<option value=" . $filaId['id'] . ">" . $filaId['nombreLote'] . "</option>";
								}
								$db_conexionId->close();
							?>
						</select>
					</div>
					<div class="col-md-6">
						<label for="lbl_cantidad" class="form-label"><b>Existencias</b></label>
						<input type="number" name="txt_cantidad" id="txt_cantidad" class="form-control" placeholder="Unidades" required>
					</div>
				</div>
				<div class="row">
                    <div class="col-md-12">
						<label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
						<textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="3" placeholder="Descripcion del medicamento / Acción del medicamento..."></textarea>
					</div>
				</div>
				<div class="row">
                    <div class="col-md-6">
						<label for="lbl_costo" class="form-label"><b>Precio de Costo</b></label>
						<input type="number" step="0.01" name="txt_costo" id="txt_costo" class="form-control" placeholder="15.25" required>
					</div>
					<div class="col-md-6">
						<label for="lbl_venta" class="form-label"><b>Precio de venta</b></label>
						<input type="number" step="0.01" name="txt_venta" id="txt_venta" class="form-control" placeholder="22.50" required>
					</div>
				</div>
				
				<div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                    <?php
                   		if (isset($_POST["btn_agregar"])) {
							include '../../controllers/medicamento/nuevoMedicamento.php';
						}
                    ?>
                    <a href="../lotesMedicina/lotesMedicina.php"><input class="btn btn-success" value="Editar Lotes"></a>
                </div>
			</form>
        </div>
		
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de Medicamento</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
						<tr>
							<th>Nombre</th>
							<th>Marca</th>
							<th>Descripcion</th>
							<th>Lote de Medicina</th>
							<th>Precio Costo</th>
							<th>Precio Venta</th>
							<th>Existencias</th>
							<th>Acciones</th>
						</tr>
						</thead>
						<tbody>
							<?php
							while ($filaMedicamento = $resultadoM->fetch_assoc()) {
								echo "<tr data-id=" . $filaMedicamento['id'] . ">";
								echo "<td>" . $filaMedicamento['nombre'] . "</td>";
								echo "<td>" . $filaMedicamento['marca'] . "</td>";
								echo "<td>" . $filaMedicamento['descripcion'] . "</td>";
								echo "<td>" . $filaMedicamento['nombreLote'] . "</td>";
								echo "<td>Q" . $filaMedicamento['precio_costo'] . "</td>";
								echo "<td>Q" . $filaMedicamento['precio_venta'] . "</td>";
								echo "<td>" . $filaMedicamento['cantidad'] . "</td>";
								echo "<td><a href='editarMedicamento.php?id=" . $filaMedicamento['id'] . "' class='btn btn-warning'>Editar</a> 
										<a href='../../controllers/medicamento/eliminarMedicamento.php?id=" . $filaMedicamento['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
								echo "</tr>";
							}
							$db_conexionMedicamento->close();
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