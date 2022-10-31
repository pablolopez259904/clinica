<?php
//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['administrador'])) 
{ 
    if (!isset($_SESSION['usuario'])) 
        { 
            /* nos envía a la siguiente dirección en el caso de no poseer autorización */
            header("location:/proyectos/clinicaProyecto/index.php"); 
    }
}

?>

<?php
	ob_start();
	require_once '../../controllers/conexion.php';

	//Citas
	$db_conexionCitas = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionCitas->real_query("SELECT c.id_cita as id, rm.rama, e.nombres, c.sintomas, c.fecha_hora FROM citas as c INNER JOIN clinicaproyecto_2021.rama_medica AS rm ON c.id_rama_medica = rm.id_rama_medica INNER JOIN clinicaproyecto_2021.empleados as e oN c.id_empleado = e.id_empleado;");
	$resultadoC = $db_conexionCitas->use_result();

	//RamasMedicas
	$db_conexionRamas = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionRamas->real_query("SELECT id_rama_medica AS id, rama FROM clinicaproyecto_2021.rama_medica;");
	$resultadoR = $db_conexionRamas->use_result();

	//Empleados --> Medicos
	$db_conexionEmpleados = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionEmpleados->real_query("SELECT id_empleado, nombres, apellidos FROM clinicaproyecto_2021.empleados WHERE id_puesto=1 ORDER BY rand() LIMIT 1;");
	$resultadoM = $db_conexionEmpleados->use_result();
	$filaMedico = $resultadoM->fetch_assoc();

    //Sucursales
    $db_conexionSucursales = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
    $db_conexionSucursales -> real_query("SELECT id_sucursal AS id, nombre FROM clinicaproyecto_2021.sucursales;");
    $resultadoSucursales = $db_conexionSucursales -> use_result();
    
?>

<?php 
    if (!isset($_SESSION['usuario'])) {
    /* nos envía a la siguiente dirección en el caso de no poseer autorización */
?>

<!doctype html>
<html lang="en">

<head>
	<title>Citas</title>
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
        <div style="padding:10px; background-color: #1B1F78; width: 110%; color:white; margin-top: 2em;">
            <h3 class="text-center">Formulario Citas</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 110%;">
            <form action="" method="POST">
				<h3><b><i><u>DATOS DEL PACIENTE</u></i></b></h3>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Nombres</b></span>
                        <input class="form-control" type="text" name="txt_nombres" id="txt_nombres" placeholder="Nombre1 Nombre2" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Apellidos</b></span>
                        <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" placeholder="Apellido1 Apellido2" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Fecha Nacimiento</b></span>
                        <input class="form-control" type="date" name="txt_fn" id="txt_fn" placeholder="dd-MM-yyyy" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Telefono</b></span>
                        <input class="form-control" type="number" name="txt_telefono" id="txt_telefono" placeholder="12345678" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Direccion</b></span>
                        <input class="form-control" type="text" name="txt_direccion" id="txt_direccion" placeholder="Ciudad, Casa No.#, Depto." required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Email</b></span>
                        <input class="form-control" type="text" name="txt_email" id="txt_email" placeholder="ejemplo@gmail.com" required>
                    </div>
                </div>


				<br><br>
				<hr size=6>
				<h3><b><i><u>DATOS DE LA CITA</u></i></b></h3>
                <div class="row">
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Rama Medica</b></label>
                        <select class="form-select" name="drop_rama" id="drop_rama" required>
                            <option value=0>--Seleccione la rama--</option>
                            <?php
                            while ($filaRama = $resultadoR->fetch_assoc()) {
                                echo "<option value=" . $filaRama['id'] . ">" . $filaRama['rama'] . "</option>";
                            }
                            $db_conexionRamas->close();
                            ?>
                        </select>
                    </div>
					<div class="col-md-6">
                        <label for="lbl_medico" class="form-label"><b>Medico que le atenderá:</b></label>
						<input type="text" name="txt_id_medico" id="txt_id_medico" class="form-control" value="<?php echo $filaMedico['id_empleado']; ?>" hidden>
						<input type="text" name="txt_medico" id="txt_medico" class="form-control" value="<?php echo"Doc. "; echo $filaMedico['nombres']; echo" "; echo $filaMedico['apellidos']; ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Sucursal</b></label>
                            <select class="form-select" name="drop_sucursal" id="drop_sucursal" required>
                            <option value=0>--Seleccione la sucursal--</option>
                            
                            <?php
                                while ($filaSucursal = $resultadoSucursales->fetch_assoc()) {
                                    echo "<option value=" . $filaSucursal['id'] . ">" . $filaSucursal['nombre'] . "</option>";
                                }
                                $db_conexionSucursales->close();
                            ?>

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Fecha y hora a solicitar</b></label>
                        <input class="form-control" type="datetime-local" name="txt_fecha_hora" id="txt_fecha_hora" placeholder="Fecha y Hora" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Sintomas</b></span>
						<textarea class="form-control" name="txt_sintomas" id="txt_sintomas" rows="3" placeholder="Descripcion de lo que tiene/siente el paciente..."></textarea>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                    <?php
                    if (isset($_POST["btn_agregar"])) {
                        include '../../controllers/citas/nuevaCita.php';
                    }
                    ?>
                    <a href="../ramaMedica/ramaMedica.php"><input class="btn btn-success" value="Ramas Medicas"></a>
                </div>
            </form>
        </div>
		<div style="padding:10px; background-color: #1B1F78; width: 110%; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de Citas</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 110%;">
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr class="text-center">
                        <th>Rama</th>
                        <th>Nombre del Medico</th>
                        <th>Fecha y Hora</th>
                        <th>Sintomas</th>
						<th>Detalles de la cita</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    while ($filaCita = $resultadoC->fetch_assoc()) {
                        echo "<tr data-id=" . $filaCita['id'] . ">";
                        echo "<td>" . $filaCita['rama'] . "</td>";
                        echo "<td>" . $filaCita['nombres'] . "</td>";
                        echo "<td>" . $filaCita['fecha_hora'] . "</td>";
                        echo "<td>" . $filaCita['sintomas'] . "</td>";
						echo "<td><a href='detalleCita.php?id=" . $filaCita['id'] . "' class='btn btn-info'>Detalles</a>";
                        echo "<td><a href='editarCitas.php?id=" . $filaCita['id'] . "' class='btn btn-warning'>Editar</a> 
                        				<a href='../../controllers/citas/eliminarCita.php?id=" . $filaCita['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                    $db_conexionCitas->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php 
    }
?>


<?php 
    if (!isset($_SESSION['administrador'])) {
?>

<!doctype html>
<html lang="en">

<head>
	<title>Citas</title>
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
        <div style="padding:10px; background-color: #1B1F78; width: 110%; color:white; margin-top: 2em;">
            <h3 class="text-center">Formulario Citas</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 110%;">
            <form action="" method="POST">
				<h3><b><i><u>DATOS DEL PACIENTE</u></i></b></h3>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Nombres</b></span>
                        <input class="form-control" type="text" name="txt_nombres" id="txt_nombres" placeholder="Nombre1 Nombre2" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Apellidos</b></span>
                        <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" placeholder="Apellido1 Apellido2" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Fecha Nacimiento</b></span>
                        <input class="form-control" type="date" name="txt_fn" id="txt_fn" placeholder="dd-MM-yyyy" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Telefono</b></span>
                        <input class="form-control" type="number" name="txt_telefono" id="txt_telefono" placeholder="12345678" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Direccion</b></span>
                        <input class="form-control" type="text" name="txt_direccion" id="txt_direccion" placeholder="Ciudad, Casa No.#, Depto." required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Email</b></span>
                        <input class="form-control" type="text" name="txt_email" id="txt_email" placeholder="ejemplo@gmail.com" required>
                    </div>
                </div>


				<br><br>
				<hr size=6>
				<h3><b><i><u>DATOS DE LA CITA</u></i></b></h3>
                <div class="row">
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Rama Medica</b></label>
                        <select class="form-select" name="drop_rama" id="drop_rama" required>
                            <option value=0>--Seleccione la rama--</option>
                            <?php
                            while ($filaRama = $resultadoR->fetch_assoc()) {
                                echo "<option value=" . $filaRama['id'] . ">" . $filaRama['rama'] . "</option>";
                            }
                            $db_conexionRamas->close();
                            ?>
                        </select>
                    </div>
					<div class="col-md-6">
                        <label for="lbl_medico" class="form-label"><b>Medico que le atenderá:</b></label>
						<input type="text" name="txt_id_medico" id="txt_id_medico" class="form-control" value="<?php echo $filaMedico['id_empleado']; ?>" hidden>
						<input type="text" name="txt_medico" id="txt_medico" class="form-control" value="<?php echo"Doc. "; echo $filaMedico['nombres']; echo" "; echo $filaMedico['apellidos']; ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Sucursal</b></label>
                            <select class="form-select" name="drop_sucursal" id="drop_sucursal" required>
                            <option value=0>--Seleccione la sucursal--</option>
                            
                            <?php
                                while ($filaSucursal = $resultadoSucursales->fetch_assoc()) {
                                    echo "<option value=" . $filaSucursal['id'] . ">" . $filaSucursal['nombre'] . "</option>";
                                }
                                $db_conexionSucursales->close();
                            ?>

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Fecha y hora a solicitar</b></label>
                        <input class="form-control" type="datetime-local" name="txt_fecha_hora" id="txt_fecha_hora" placeholder="Fecha y Hora" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Sintomas</b></span>
						<textarea class="form-control" name="txt_sintomas" id="txt_sintomas" rows="3" placeholder="Descripcion de lo que tiene/siente el paciente..."></textarea>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                    <?php
                    if (isset($_POST["btn_agregar"])) {
                        include '../../controllers/citas/nuevaCita.php';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<?php 
    }
 
?>