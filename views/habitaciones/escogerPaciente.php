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
    //PACIENTES
    $db_conexionPacientes = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionPacientes->real_query("SELECT id_paciente AS id,nombres,apellidos FROM pacientes;");
    $resultadoPacientes = $db_conexionPacientes->use_result();

    //HABITACIONES
    $db_conexionHabitaciones = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $idEdit = utf8_decode($_GET["id"]);
    $db_conexionHabitaciones->real_query("SELECT h.sector, h.numero, s.nombre, s.direccion FROM habitaciones AS h INNER JOIN sucursales AS s ON h.id_sucursal = s.id_sucursal WHERE h.id_habitacion = $idEdit ORDER BY s.nombre");
    $resultadoHabitaciones = $db_conexionHabitaciones->use_result();
    $idHabitacion = $resultadoHabitaciones->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Escoger Paciente</title>
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
            <h3 class="text-center">Escoger un Paciente</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" id="id" value="<?php echo $idHabitacion['id']; ?>">
                        <label for="drop_paciente" class="form-label"><b>Paciente que ocupará la habitación:</b></label>
                        <select class="form-select" name="drop_paciente" id="drop_paciente" required>
                            <option value=0>-- Seleccione el paciente --</option>
                            <?php
                                while ($filaPaciente = $resultadoPacientes->fetch_assoc()) {
                                    echo "<option value=" . $filaPaciente['id'] . ">" . $filaPaciente['nombres'] ." ". $filaPaciente['apellidos'] . "</option>";
                                }
                                $db_conexionPacientes->close();
                            ?>
                        </select>
                    </div>                        
                    <div class="col-md-6">
                        <label for="txt_sector" class="form-label"><b>Sector</b></label>
                        <input type="text" name="txt_sector" id="txt_sector" class="form-control" value="<?php echo $idHabitacion['sector']; ?>" disabled>
                    </div>
                </div>

                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <label for="txt_numero" class="form-label"><b>Numero de Habitacion</b></label>
                        <input type="text" name="txt_numero" id="txt_numero" class="form-control" value="<?php echo $idHabitacion['numero']; ?>" disabled>
                    </div>                     
                    <div class="col-md-6">
                        <label for="txt_nombre" class="form-label"><b>Nombre de Sucursal</b></label>
                        <input type="text" name="txt_nombre" id="txt_nombre" class="form-control" value="<?php echo $idHabitacion['nombre']; ?>" disabled>
                    </div>
                </div>

                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-12">
                        <label for="txt_direccion" class="form-label"><b>Direccion</b></label>
                        <textarea class="form-control" name="txt_direccion" id="txt_direccion" rows="3" disabled> <?php echo $idHabitacion['direccion']; ?> </textarea>
                    </div>
                </div>

                <div class="text-center" style="margin-top: 2em;">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Asignar a Habitación">
                    <?php
                    if (isset($_POST["btn_agregar"])) {
                        include '../../controllers/habitaciones/asignarPaciente.php';
                        // Solo llevar el ID de habitacion y el id del paciente para asignarlo --> Llevarlo a un UPDATE de habitaciones_reservadas 
                    }
                    ?>
                    <a href="habitacionesOcupadas.php"><input class="btn btn-success" value="Habitaciones Reservadas"></a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>