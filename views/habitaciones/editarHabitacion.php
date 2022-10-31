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
    $db_conexionUEditar->real_query("SELECT h.id_habitacion, h.sector, h.numero, s.nombre, s.direccion, s.id_sucursal FROM habitaciones AS h INNER JOIN sucursales AS s ON h.id_sucursal = s.id_sucursal WHERE id_habitacion = ". $idEdit .";");
    $resultadoUEdit = $db_conexionUEditar->use_result();
    $filaHabitacionesEdit = $resultadoUEdit->fetch_assoc();

    //SUCURSALES
    $db_conexionPuestos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionPuestos->real_query("SELECT id_sucursal as id, nombre, direccion FROM sucursales;");
    $resultadoREdit = $db_conexionPuestos->use_result();
    $idSucursales = $resultadoREdit->fetch_assoc();
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
    <div class="col-md-8" style="margin-left: 50px; margin-top: 1em;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Editar Habitaciones</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" id="id" value="<?php echo $filaHabitacionesEdit['id_habitacion']; ?>">
                        <label for="lbl_sector" class="form-label"><b>Sector</b></label>
                        <input type="text" name="txt_sector" id="txt_sector" class="form-control" value="<?php echo $filaHabitacionesEdit['sector']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_numero" class="form-label"><b>Número</b></label>
                        <input type="text" name="txt_numero" id="txt_numero" class="form-control" value="<?php echo $filaHabitacionesEdit['numero']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="drop_sucursal" class="form-label"><b>Sucursal</b></label>
                        <select class="form-select" name="drop_sucursal" id="drop_sucursal">
                            <option value="<?php echo $idSucursales['id']; ?>"><?php echo $idSucursales['nombre']; ?></option>
                            
                            <?php
                                while ($filaSucursal = $resultadoREdit->fetch_assoc()) {
                                    echo "<option value=" . $filaSucursal['id'] . ">" . $filaSucursal['nombre'] . "</option>";
                                }
                                $db_conexionPuestos->close();
                            ?>
                        </select>
                    </div>
                </div>
                <div style="margin-top: 1em;">
                    <a href="habitaciones.php" class="btn btn-success">Regresar</a> &nbsp;&nbsp;
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar">
                    <?php
                    if (isset($_POST["btn_editar"])) {
                        include '../../controllers/habitaciones/editarHabitacion.php';
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