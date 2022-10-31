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

//personas
$db_conexionEmpleados = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionEmpleados->real_query("SELECT e.id_empleado as id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, e.fecha_nacimiento, p.puesto FROM clinicaproyecto_2021.empleados AS e INNER JOIN clinicaproyecto_2021.puestos AS p ON e.id_puesto = p.id_puesto ORDER BY e.nombres;");
$resultadoU = $db_conexionEmpleados->use_result();

//puestos
$db_conexionPuestos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionPuestos->real_query("SELECT id_puesto AS id, puesto FROM clinicaproyecto_2021.puestos;");
$resultadoR = $db_conexionPuestos->use_result();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Empleados</title>

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
            <h3 class="text-center">Formulario empleados</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="lbl_codigo" class="form-label"><b>*Codigo</b></label>
                        <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="E001" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_puesto" class="form-label"><b>*Puesto</b></label>
                        <select class="form-select" name="drop_puesto" id="drop_puesto" required>
                            <option value=0>Seleccione el puesto</option>
                            <?php
                            while ($filapuesto = $resultadoR->fetch_assoc()) {
                                echo "<option value=" . $filapuesto['id'] . ">" . $filapuesto['puesto'] . "</option>";
                            }
                            $db_conexionPuestos->close();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>*Nombres</b></span>
                        <input class="form-control" type="text" name="txt_nombres" id="txt_nombres" placeholder="Nombre1 Nombre2" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>*Apellidos</b></span>
                        <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" placeholder="Apellido1 Apellido2" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>*Telefono</b></span>
                        <input class="form-control" type="number" name="txt_telefono" id="txt_telefono" placeholder="55553311" required>
                    </div>
                    <div class="col-md-6">
                        <span><b>*Fecha de nacimiento</b></span>
                        <input class="form-control" type="date" name="txt_fecha" id="txt_fecha" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-12">
                        <label for="lbl_direccion" class="form-label"><b>*Direccion</b></label>
                        <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Ciudad, Casa No.#, Depto." required>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                    <?php
                    if (isset($_POST["btn_agregar"])) {
                        include '..\..\controllers\empleados\nuevoEmpleado.php';
                    }
                    ?>
                    <a href="puestos.php"><input class="btn btn-success" value="Editar puestos"></a>
                </div>
            </form>
        </div>
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de empleados</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Codigo</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Direccion</th>
                                <th>Puesto</th>
                                <th>Telefono</th>
                                <th>Fecha de nacimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            while ($filaEmpleado = $resultadoU->fetch_assoc()) {
                                echo "<tr data-id=" . $filaEmpleado['id'] . ">";
                                echo "<td>" . $filaEmpleado['codigo'] . "</td>";
                                echo "<td>" . $filaEmpleado['nombres'] . "</td>";
                                echo "<td>" . $filaEmpleado['apellidos'] . "</td>";
                                echo "<td>" . $filaEmpleado['direccion'] . "</td>";
                                echo "<td>" . $filaEmpleado['puesto'] . "</td>";
                                echo "<td>" . $filaEmpleado['telefono'] . "</td>";
                                echo "<td>" . $filaEmpleado['fecha_nacimiento'] . "</td>";
                                echo "<td><a href='editarEmpleados.php?id=" . $filaEmpleado['id'] . "' class='btn btn-warning'>Editar</a> 
                        				<a href='../../controllers/empleados/eliminarEmpleado.php?id=" . $filaEmpleado['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                                echo "</tr>";
                            }
                            $db_conexionEmpleados->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>