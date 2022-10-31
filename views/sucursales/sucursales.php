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

//SUCURSALES
$db_conexionRoles = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionRoles->real_query("SELECT id_sucursal as id, nombre, direccion FROM sucursales;");
$resultadoR = $db_conexionRoles->use_result();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Sucursales</title>
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
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Formulario sucursales</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row">
                <form class="d-flex" action="" method="POST">
                    <div class="col">
                        <div class="col-md-12">
                            <label for="lbl_nombre" class="form-label"><b>Nombre</b></label>
                            <input type="text" name="txt_nombre" id="txt_nombre" class="form-control" placeholder="Nombre de la sucursal" required>
                        </div>
                        <div class="col-md-12">
                            <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
                            <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Ciudad, numero de casa #, depto." required>
                        </div>
                        <br>
                        <div class="text-center">
                                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                                <a href="../habitaciones/habitaciones.php" class="btn btn-success">Habitaciones de Sucursales</a>
                            <?php
                            if (isset($_POST["btn_agregar"])) {
                                include '..\..\controllers\sucursales\nuevaSucursal.php';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Lista de sucursales</h3>
        </div>
        <div style="padding:10px; background-color: white;">
            <div class="row" style="margin-top: 1em;">
                <div class="col-md-12">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse" style="padding:10px;">
                            <tr class="text-center">
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Dirección</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            while ($fila = $resultadoR->fetch_assoc()) {
                                echo "<tr data-id=" . $fila['id'] . ">";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>" . $fila['direccion'] . "</td>";
                                echo "<td><a href='editarSucursal.php?id=" . $fila['id'] . "' class='btn btn-warning'>Editar</a>
								        <a href='../../controllers/sucursales/eliminarSucursal.php?id=" . $fila['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                                echo "</tr>";
                            }
                            $db_conexionRoles->close();
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