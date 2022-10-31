
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
    $id = utf8_decode($_GET["id"]);
    

    //CITAS
    $db_conexionCitas = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionCitas->real_query("SELECT pacientes.id_paciente,
                                          pacientes.nombres,
                                          pacientes.apellidos,
                                          pacientes.fecha_nacimiento,
                                          pacientes.telefono,
                                          pacientes.direccion,
                                          pacientes.correo_electronico,
                                          citas.id_cita,
                                          rama_medica.rama,
                                          citas.sintomas,
                                          citas.fecha_hora,
                                          sucursales.nombre as sucursal
                                          FROM detalle_citas
                                          INNER JOIN pacientes
                                          ON detalle_citas.id_paciente = pacientes.id_paciente
                                          INNER JOIN citas
                                          ON detalle_citas.id_cita = citas.id_cita
                                          INNER JOIN rama_medica
                                          ON citas.id_rama_medica = rama_medica.id_rama_medica
                                          INNER JOIN sucursales
                                          ON detalle_citas.id_sucursal = sucursales.id_sucursal
                                          WHERE citas.id_cita = ".$id.";");
	$resultadoCitas = $db_conexionCitas->use_result();
    $filaCitas = $resultadoCitas->fetch_assoc();

    //RAMAS MEDICAS
    $db_conexionRamas = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionRamas -> real_query("SELECT id_rama_medica AS id, rama FROM rama_medica;");
    $resultadoRamas = $db_conexionRamas -> use_result();
    $idRamas = $resultadoRamas -> fetch_assoc();
    
    //SUCURSALES
    $db_conexionSucursales = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionSucursales->real_query("SELECT id_sucursal as id, nombre FROM sucursales;");
    $resultadoSucursales = $db_conexionSucursales->use_result();
    $idSucursales = $resultadoSucursales->fetch_assoc();

    //EMPLEADOS
    $db_conexionEmpleados = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
	$db_conexionEmpleados->real_query("SELECT id_empleado, nombres, apellidos FROM clinicaproyecto_2021.empleados WHERE id_puesto=1 ORDER BY rand() LIMIT 1;");
	$resultadoM = $db_conexionEmpleados->use_result();
	$filaMedico = $resultadoM->fetch_assoc();

?>

<!doctype html>
<html lang="en">
<head>
	<title>Editar Citas</title>
	<link rel="shortcut icon" href="imgs/titleUsuarios.png" />
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<?php 
    include '../cabecera.php'; 
?>

<body background="../../imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
    <div class="col-md-8" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Editar Cita</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
				<h3><b><i><u>DATOS DEL PACIENTE</u></i></b></h3>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <input class="form-control" type="hidden" name="txt_idPaciente" id="txt_idPaciente" value="<?php echo $filaCitas['id_paciente'];?>" required>
                        <span><b>Nombres</b></span>
                        <input class="form-control" type="text" name="txt_nombres" id="txt_nombres" value="<?php echo $filaCitas['nombres'];?>" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Apellidos</b></span>
                        <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" value="<?php echo $filaCitas['apellidos'];?>" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Fecha Nacimiento</b></span>
                        <input class="form-control" type="date" name="txt_fn" id="txt_fn" value="<?php echo $filaCitas['fecha_nacimiento'];?>" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Telefono</b></span>
                        <input class="form-control" type="number" name="txt_telefono" id="txt_telefono" value="<?php echo $filaCitas['telefono'];?>" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Direccion</b></span>
                        <input class="form-control" type="text" name="txt_direccion" id="txt_direccion" value="<?php echo $filaCitas['direccion'];?>" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Email</b></span>
                        <input class="form-control" type="text" name="txt_email" id="txt_email" value="<?php echo $filaCitas['correo_electronico'];?>" required>
                    </div>
                </div>
				<br><br>
				<hr size=6>
				<h3><b><i><u>DATOS DE LA CITA</u></i></b></h3>
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" type="hidden" name="txt_idCita" id="txt_idCita" value="<?php echo $filaCitas['id_cita'];?>" required>
                        <label for="lbl_rama" class="form-label"><b>Rama Medica</b></label>
                        <select class="form-select" name="drop_rama" id="drop_rama" required>
                            <option value="<?php echo $idRamas['id']; ?>"><?php echo $idRamas['rama']; ?> </option>
                            <?php
                            while ($filaRama = $resultadoRamas->fetch_assoc()) {
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
                            <option value="<?php echo $idSucursales['id'];?>"><?php echo $idSucursales['nombre'];?></option>
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
                        <input class="form-control" type="datetime-local" name="txt_fecha_hora" id="txt_fecha_hora" value="<?php echo date('Y-m-d\TH:i', strtotime($filaCitas['fecha_hora']));?>" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Sintomas</b></span>
						<!--<textarea class="form-control" name="txt_sintomas" id="txt_sintomas" rows="3" value=""></textarea>-->
                        <textarea class="form-control" name="txt_sintomas" id="txt_sintomas" rows="3"><?php echo $filaCitas['sintomas'];?></textarea>
                    </div>
                <div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Guardar">
                    <?php
                    if (isset($_POST["btn_editar"])) {
                        include '../../controllers/citas/editCitas.php';
                    }
                    ?>
                    <a href="citas.php"><input class="btn btn-success" value="Regresar"></a>
                </div>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>