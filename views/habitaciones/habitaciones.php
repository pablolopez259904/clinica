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
    //Habitaciones
    $db_conexionHabitaciones = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionHabitaciones->real_query("SELECT h.id_habitacion, h.sector, h.numero, s.nombre, s.direccion FROM habitaciones AS h INNER JOIN sucursales AS s ON h.id_sucursal = s.id_sucursal ORDER BY s.nombre;");
    $resultadoHabitaciones = $db_conexionHabitaciones->use_result();

    //Sucursales
    $db_conexionSucursales = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionSucursales->real_query("SELECT id_sucursal as id, nombre FROM sucursales;");
    $resultadoSucursales = $db_conexionSucursales->use_result();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Habitaciones</title>
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
            <h3 class="text-center">Formulario Habitaciones</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="txt_sector" class="form-label"><b>Sector</b></label>
                        <input type="text" name="txt_sector" id="txt_sector" class="form-control" placeholder="A, B, C..." required>
                    </div>
                    <div class="col-md-6">
                        <label for="txt_numero" class="form-label"><b>Número</b></label>
                        <input type="text" name="txt_numero" id="txt_numero" class="form-control" placeholder="1, 2, 3..." required>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <label for="drop_sucursal" class="form-label"><b>Sucursal</b></label>
                        <select class="form-select" name="drop_sucursal" id="drop_sucursal" required>
                            <option value=0>-- Seleccione la sucursal --</option>
                            <?php
                                while ($filaSucursales = $resultadoSucursales->fetch_assoc()) {
                                    echo "<option value=" . $filaSucursales['id'] . ">" . $filaSucursales['nombre'] . "</option>";
                                }
                                $db_conexionSucursales->close();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 1em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                    <?php
                    if (isset($_POST["btn_agregar"])) {
                        include '../../controllers/habitaciones/nuevaHabitacion.php';
                        include '../../controllers/habitaciones/nuevaHabitacion2.php';
                    }
                    ?>
                    <a href="../habitaciones/habitacionesOcupadas.php"><input class="btn btn-success" value="Habitaciones Reservadas"></a>
                    <a href="../sucursales/sucursales.php"><input class="btn btn-success" value="Regresar a Sucursales"></a>
                </div>
            </form>
        </div>
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Listado de Habitaciones</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th style="text-align: center">Nombre de Sucursal</th>
                            <th style="text-align: center">Dirección</th>
                            <th style="text-align: center">Sector</th>
                            <th style="text-align: center">Número de Habitacion</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                        while ($filaHabitaciones = $resultadoHabitaciones->fetch_assoc()) {
                            echo "<tr data-id=" . $filaHabitaciones['id_habitacion'] . ">";
                            echo "<td>" . $filaHabitaciones['nombre'] . "</td>";
                            echo "<td>" . $filaHabitaciones['direccion'] . "</td>";
                            echo "<td>" . $filaHabitaciones['sector'] . "</td>";
                            echo "<td>" . $filaHabitaciones['numero'] . "</td>";
                            echo "<td><a href='editarHabitacion.php?id=" . $filaHabitaciones['id_habitacion'] . "' class='btn btn-warning'>Editar</a> 
                        				<a href='../../controllers/habitaciones/eliminarHabitacion.php?id=" . $filaHabitaciones['id_habitacion'] . "' class='btn btn-danger'>Eliminar</a></td>";
                            echo "</tr>";
                        }
                        $db_conexionHabitaciones->close();
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