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

//ROLES
$db_conexionRoles = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionRoles->real_query("SELECT id_puesto as id, puesto FROM puestos;");
$resultadoR = $db_conexionRoles->use_result();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Puestos</title>
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
    <div class="col-md-7" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Formulario puestos</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row">
                <form class="d-flex" action="" method="POST">
                    <div class="col">
                        <div class="col-md-12">
                            <label for="lbl_rol" class="form-label"><b>*Puesto</b></label>
                            <input type="text" name="txt_puesto" id="txt_puesto" class="form-control" placeholder="ingrese el nuevo puesto" required>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Guardar">
                            </div>

                            <div class="col-md-6" align="right">
                                <a href="./personas.php" class="btn btn-success">Regresar</a>
                            </div>
                            <?php
                            if (isset($_POST["btn_agregar"])) {
                                include '..\..\controllers\empleados\nuevoPuesto.php';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 3em;">
            <h3 class="text-center">Lista de puestos</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse" style="padding:10px;">
                            <tr class="text-center">
                                <th>Nombre del puesto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            while ($filaPuesto = $resultadoR->fetch_assoc()) {
                                echo "<tr data-id=" . $filaPuesto['id'] . ">";
                                echo "<td>" . $filaPuesto['puesto'] . "</td>";
                                echo "<td><a href='editarpuesto.php?id=" . $filaPuesto['id'] . "' class='btn btn-warning'>Editar</a> 
								<a href='../../controllers/empleados/eliminarPuesto.php?id=" . $filaPuesto['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
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