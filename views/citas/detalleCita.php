
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

    $db_conexionDCEditar = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $idEdit = utf8_decode($_GET["id"]);
    //$db_conexionDCEditar->real_query("SELECT dc.id_detalle_cita, s.nombre AS nombreSucursal, p.nombres AS nombrePaciente, c.sintomas, u.nombres AS nombreUsuario 
    //                                    FROM clinicaproyecto_2021.detalle_citas AS dc INNER JOIN clinicaproyecto_2021.sucursales as s ON dc.id_sucursal = s.id_sucursal 
    //                                    INNER JOIN clinicaproyecto_2021.pacientes AS p ON dc.id_paciente = p.id_paciente INNER JOIN clinicaproyecto_2021.citas AS c 
    //                                    ON dc.id_cita = c.id_cita INNER JOIN clinicaproyecto_2021.usuarios AS u ON dc.id_usuario = u.id_usuario WHERE id_detalle_cita = $idEdit;");
    $db_conexionDCEditar -> real_query("SELECT  pacientes.nombres,
                                                pacientes.apellidos,
                                                pacientes.fecha_nacimiento,
                                                pacientes.telefono,
                                                pacientes.direccion,
                                                pacientes.correo_electronico, 
                                                sucursales.nombre AS sucursal,
                                                citas.sintomas,
                                                citas.fecha_hora,
                                                rama_medica.rama,
                                                empleados.nombres AS nombre_empleado,
                                                usuarios.nombres AS nombre_usuario
                                                FROM citas
                                                INNER JOIN detalle_citas
                                                ON citas.id_cita = detalle_citas.id_cita
                                                INNER JOIN sucursales
                                                ON detalle_citas.id_sucursal = sucursales.id_sucursal
                                                INNER JOIN pacientes
                                                ON detalle_citas.id_paciente = pacientes.id_paciente
                                                INNER JOIN rama_medica
                                                ON citas.id_rama_medica = rama_medica.id_rama_medica
                                                INNER JOIN empleados
                                                ON citas.id_empleado = empleados.id_empleado
                                                INNER JOIN usuarios
                                                ON usuarios.id_usuario = detalle_citas.id_usuario
                                                WHERE citas.id_cita = ".$idEdit.";");
    $resultadoDCEdit = $db_conexionDCEditar->use_result();
    $filaDCEdit = $resultadoDCEdit->fetch_assoc();

?>

<!doctype html>
<html lang="en">
<head>
    <title>Detalles de la cita</title>
    <link rel="shortcut icon" href="imgs\titleUsuarios.png" />
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
            <h3 class="text-center">Detalles de la Cita</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="lbl_sucursal" class="form-label"><b>Sucursal</b></label>
                        <input type="text" name="txt_sucursal" id="txt_sucursal" class="form-control" value="<?php echo $filaDCEdit['sucursal']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Rama</b></label>
                        <input type="text" name="txt_rama" id="txt_rama" class="form-control" value="<?php echo $filaDCEdit['rama']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Nombres</b></label>
                        <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" value="<?php echo $filaDCEdit['nombres']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Apellidos</b></label>
                        <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" value="<?php echo $filaDCEdit['apellidos']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Fecha de Nacimiento</b></label>
                        <input type="text" name="txt_fn" id="txt_fn" class="form-control" value="<?php echo $filaDCEdit['fecha_nacimiento']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Teléfono</b></label>
                        <input type="text" name="txt_telefono" id="txt_telefono" class="form-control" value="<?php echo $filaDCEdit['telefono']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Dirección</b></label>
                        <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" value="<?php echo $filaDCEdit['direccion']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Correo electrónico</b></label>
                        <input type="text" name="txt_correo" id="txt_correo" class="form-control" value="<?php echo $filaDCEdit['correo_electronico']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Sintomas del paciente</b></label>
                        <textarea class="form-control" name="txt_sintomas" id="txt_sintomas" rows="3" disabled><?php echo $filaDCEdit['sintomas'];?></textarea>
                        <!--<input type="text" name="txt_sintomas" id="txt_sintomas" class="form-control" value="" disabled>-->
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Fecha y hora de la cita</b></label>
                        <input type="text" name="txt_hora" id="txt_hora" class="form-control" value="<?php echo $filaDCEdit['fecha_hora']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Especialista que atenderá</b></label>
                        <input type="text" name="txt_empleado" id="txt_empleado" class="form-control" value="<?php echo 'Doc. ', $filaDCEdit['nombre_empleado']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_paciente" class="form-label"><b>Usurario que creó la cita</b></label>
                        <input type="text" name="txt_usuario" id="txt_usuario" class="form-control" value="<?php echo $filaDCEdit['nombre_usuario']; ?>" disabled>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 1em;">
                    <a href="citas.php"><input class="btn btn-success" value="Regresar"></a>
                </div>
            </form>
        </div>
    </div>
    <?php $db_conexionDCEditar->close(); ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>