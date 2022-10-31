

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

$db_conexionUEditar = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$idEdit = utf8_decode($_GET["id"]);
$db_conexionUEditar->real_query("SELECT e.id_empleado as id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, e.fecha_nacimiento, p.puesto FROM clinicaproyecto_2021.empleados AS e INNER JOIN clinicaproyecto_2021.puestos AS p ON e.id_puesto = p.id_puesto  WHERE id_empleado = $idEdit;");
$resultadoUEdit = $db_conexionUEditar->use_result();
$filaEmpleadosEdit = $resultadoUEdit->fetch_assoc();

//puestos
$db_conexionPuestos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionPuestos->real_query("SELECT id_puesto AS id, puesto FROM clinicaproyecto_2021.puestos;");
$resultadoREdit = $db_conexionPuestos->use_result();
$idEmpleadoR = $resultadoREdit->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Editar empleado</title>
    <link rel="shortcut icon" href="imgs\titleUsuarios.png" />

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<?php include '../cabecera.php'; ?>


<body background="../../imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
    <div class="col-md-8" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Editar empleado</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" id="id" value="<?php echo $filaEmpleadosEdit['id']; ?>">
                        <label for="lbl_codigo" class="form-label"><b>*Codigo</b></label>
                        <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" value="<?php echo $filaEmpleadosEdit['codigo']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_puesto" class="form-label"><b>*Puesto</b></label>
                        <select class="form-select" name="drop_puesto" id="drop_puesto">
                            <option value="<?php echo $idEmpleadoR['id']; ?>"><?php echo $idEmpleadoR['puesto']; ?></option>
                            <?php
                            while ($filapuesto = $resultadoREdit->fetch_assoc()) {
                                echo "<option value=" . $filapuesto['id'] . ">" . $filapuesto['puesto'] . "</option>";
                            }
                            $db_conexionPuestos->close();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="lbl_nombres" class="form-label"><b>*Nombres</b></label>
                        <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" value="<?php echo $filaEmpleadosEdit['nombres']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_apellidos" class="form-label"><b>*Apellidos</b></label>
                        <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" value="<?php echo $filaEmpleadosEdit['apellidos']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span><b>*Telefono</b></span>
                        <input class="form-control" type="number" name="txt_telefono" id="txt_telefono" value="<?php echo $filaEmpleadosEdit['telefono']; ?>">
                    </div>
                    <div class="col-md-6">
                        <span><b>*Fecha de nacimiento</b></span>
                        <input class="form-control" type="date" name="txt_fecha" id="txt_fecha" value="<?php echo $filaEmpleadosEdit['fecha_nacimiento']; ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-12">
                        <label for="lbl_direccion" class="form-label"><b>direccion</b></label>
                        <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" value="<?php echo $filaEmpleadosEdit['direccion']; ?>">
                    </div>
                </div>
                <div style="margin-top: 1em;">
                    <a href="http://localhost/proyectos/clinicaProyecto/views/empleados/personas.php" class="btn btn-success">Regresar</a> &nbsp;&nbsp;
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar">
                    <?php
                    if (isset($_POST["btn_editar"])) {
                        include '../../controllers/empleados/editarEmpleado.php';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <?php $db_conexionUEditar->close(); ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>