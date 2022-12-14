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

    //USUARIOS
    $db_conexionUEdit = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $idEdit = utf8_decode($_GET["id"]);
    $db_conexionUEdit -> real_query("SELECT u.id_usuario as id, u.email, u.nombres, u.apellidos, u.password, r.rol FROM clinicaproyecto_2021.usuarios AS u INNER JOIN clinicaproyecto_2021.roles AS r ON u.id_rol = r.id_rol WHERE id_usuario = $idEdit;");
    $resultadoUEdit = $db_conexionUEdit -> use_result();
    $filaUsuariosEdit = $resultadoUEdit -> fetch_assoc();

    //ROLES
    $db_conexionREdit = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionREdit->real_query("SELECT id_rol AS id, rol FROM clinicaproyecto_2021.roles;");
    $resultadoREdit = $db_conexionREdit->use_result();
    $idUsuarioR = $resultadoREdit->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Editar Usuario</title>
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
            <h3 class="text-center">Editar Usuario</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
            <div class="col">

                <input type="hidden" name="id" id="id" value="<?php echo $filaUsuariosEdit['id']; ?>">
                <div class="mb-3">
                    <label for="lbl_email" class="form-label"><b>Email</b></label>
                    <input type="text" name="txt_email" id="txt_email" class="form-control" value="<?php echo $filaUsuariosEdit['email']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" value="<?php echo $filaUsuariosEdit['nombres']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" value="<?php echo $filaUsuariosEdit['apellidos']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_password" class="form-label"><b>Password</b></label>
                    <input type="text" name="txt_password" id="txt_password" class="form-control" value="<?php echo $filaUsuariosEdit['password']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_rol" class="form-label"><b>Rol</b></label>
                    <select class="form-select" name="drop_rol" id="drop_rol" required>
                        <option value="<?php echo $idUsuarioR['id']; ?>"><?php echo $idUsuarioR['rol']; ?></option>

                        <?php
                        while ($filaRol = $resultadoREdit->fetch_assoc()) {
                            echo "<option value=" . $filaRol['id'] . ">" . $filaRol['rol'] . "</option>";
                        }
                        $db_conexionREdit->close();
                        ?>

                    </select>
                </div>

                <?php $db_conexionUEdit->close(); ?>

                <div class="mb-3">
                    <a href="usuarios.php" class="btn btn-info">Regresar</a> &nbsp;&nbsp;
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-success" value="Editar">
                </div>
            </div>
        </form>
        </div>

    </div>

    <?php

    if (isset($_POST["btn_editar"])) {
        include '../../controllers/usuarios/editUsuario.php';
    }

    ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
