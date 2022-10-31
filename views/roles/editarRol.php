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
    $db_conexionREdit = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $idEdit = utf8_decode($_GET["id"]);
    $db_conexionREdit -> real_query("SELECT id_rol as id, rol FROM roles WHERE id_rol = $idEdit;");
    $resultadoREdit = $db_conexionREdit -> use_result();
    $filaRolesEdit = $resultadoREdit -> fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Roles</title>
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
            <h3 class="text-center">Formulario Usuarios</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
            <div class="col">

                <input type="hidden" name="id" id="id" value="<?php echo $filaRolesEdit['id']; ?>">
                <div class="mb-3">
                    <label for="lbl_rol" class="form-label"><b>Rol de Usuario</b></label>
                    <input type="text" name="txt_rol" id="txt_rol" class="form-control" value="<?php echo $filaRolesEdit['rol']; ?>">
                </div>

                <div class="mb-3">
                    <a href="roles.php" class="btn btn-info">Regresar</a> &nbsp;&nbsp;
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-success" value="Editar Rol">
                </div>
            </div>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST["btn_editar"])) {
        include '../../controllers/rolesUsuario/editRol.php';
    }

    ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>