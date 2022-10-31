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
    //HABITACIONES RESERVADAS
    $db_conexionHabitaciones = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionHabitaciones->real_query("SELECT h.id_habitacion, h.sector, h.numero, s.nombre, hr.estado, p.nombres, p.apellidos FROM habitaciones AS h INNER JOIN sucursales AS s ON h.id_sucursal = s.id_sucursal INNER JOIN habitacion_reservada AS hr ON h.id_habitacion = hr.id_habitacion INNER JOIN pacientes AS p ON hr.id_paciente = p.id_paciente;");
    $resultadoHabitaciones = $db_conexionHabitaciones->use_result();

    //HABITACIONES LIBRES
    $db_conexionHabitacionesL = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionHabitacionesL->real_query("SELECT h.id_habitacion, h.sector, h.numero, s.nombre, hr.estado FROM habitaciones AS h INNER JOIN sucursales AS s ON h.id_sucursal = s.id_sucursal INNER JOIN habitacion_reservada AS hr ON h.id_habitacion = hr.id_habitacion WHERE hr.estado = 'Libre';");
    $resultadoHabitacionesL = $db_conexionHabitacionesL->use_result();

    //Sucursales
    $db_conexionSucursales = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionSucursales->real_query("SELECT id_sucursal as id, nombre FROM sucursales;");
    $resultadoSucursales = $db_conexionSucursales->use_result();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Habitaciones Reservadas</title>
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
            <A name="HR"><h3 class="text-center">Listado de Habitaciones Reservadas</h3></A>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <a href="habitaciones.php"><input class="btn btn-success" value="Listado de Habitaciones"></a> &nbsp;&nbsp;
            <A href="#HL" class="btn btn-info">Habitaciones Libres</A>
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th style="text-align: center">Nombre de Sucursal</th>
                            <th style="text-align: center">Sector</th>
                            <th style="text-align: center">Número de Habitacion</th>
                            <th style="text-align: center">Estado</th>
                            <th style="text-align: center">Paciente</th>
                            <th style="text-align: center">Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                        while ($filaHabitaciones = $resultadoHabitaciones->fetch_assoc()) {
                            echo "<tr data-id=" . $filaHabitaciones['id_habitacion'] . ">";
                            echo "<td>" . $filaHabitaciones['nombre'] . "</td>";
                            echo "<td>" . $filaHabitaciones['sector'] . "</td>";
                            echo "<td>" . $filaHabitaciones['numero'] . "</td>";
                            echo "<td>" . $filaHabitaciones['estado'] . "</td>";
                            echo "<td>" . $filaHabitaciones['nombres'] ." ". $filaHabitaciones['apellidos'] ."</td>";
                            echo "<td><a href='../../controllers/habitaciones/estadoLibre.php?id=" . $filaHabitaciones['id_habitacion'] . "' class='btn btn-success'>Liberar</a> </td>";
                            echo "</tr>";
                        }
                        $db_conexionHabitaciones->close();
                    ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>

        
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <A name="HL"><h3 class="text-center">Listado de Habitaciones Libres</h3></A>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <a href="habitaciones.php"><input class="btn btn-success" value="Listado de Habitaciones"></a> &nbsp;&nbsp;
            <A href="#HR" class="btn btn-info">Habitaciones Ocupadas</A>
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th style="text-align: center">Nombre de Sucursal</th>
                            <th style="text-align: center">Sector</th>
                            <th style="text-align: center">Número de Habitacion</th>
                            <th style="text-align: center">Estado</th>
                            <th style="text-align: center">Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                        while ($filaHabitacionesL = $resultadoHabitacionesL->fetch_assoc()) {
                            echo "<tr data-id=" . $filaHabitacionesL['id_habitacion'] . ">";
                            echo "<td>" . $filaHabitacionesL['nombre'] . "</td>";
                            echo "<td>" . $filaHabitacionesL['sector'] . "</td>";
                            echo "<td>" . $filaHabitacionesL['numero'] . "</td>";
                            echo "<td>" . $filaHabitacionesL['estado'] . "</td>";
                            echo "<td> <a href='escogerPaciente.php?id=" . $filaHabitacionesL['id_habitacion'] . "' class='btn btn-danger'>Ocupar</a> </td>";
                            echo "</tr>";
                        }
                        $db_conexionHabitacionesL->close();
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