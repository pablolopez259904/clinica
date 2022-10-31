<?php
ob_start();
require_once 'controllers/conexion.php';

//USUARIOS
$db_conexionUsuarios = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionUsuarios->real_query("SELECT u.id_usuario as id, u.email, u.nombres, u.apellidos, u.password, r.rol FROM clinicaproyecto_2021.usuarios AS u INNER JOIN clinicaproyecto_2021.roles AS r ON u.id_rol = r.id_rol ORDER BY u.nombres;");
$resultadoU = $db_conexionUsuarios->use_result();

//ROLES
$db_conexionRoles = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionRoles->real_query("SELECT id_rol AS id, rol FROM clinicaproyecto_2021.roles;");
$resultadoR = $db_conexionRoles->use_result();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Usuarios</title>
    <link rel="shortcut icon" href="views/usuario/imgs/titleUsuarios.png" />

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body background="imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat;">
    <div class="container" style="margin-top: 2%; box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.5);">
        <div class="row">
            <div class="col-md-12" style="padding: 2%; background-color: #1B1F78; color: white;">
                <h3 class="text-center">Registrar Usuario</h3>
            </div>
            <div class="col-md-6">
                <div style="background-color: white;">
                    <form action="" method="POST">
                        <div class="row" style="padding: 5%">
                            <div class="col-md-12" style="margin-top: 1em;">
                                <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombre1 Nombre2" required>
                            </div>

                            <div class="col-md-12" style="margin-top: 1em;">
                                <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellido1 Apellido2" required>
                            </div>

                            <div class="col-md-12" style="margin-top: 1em;">
                                <label for="lbl_email" class="form-label"><b>Email</b></label>
                                <input type="text" name="txt_email" id="txt_email" class="form-control" placeholder="ejemplo@gmail.com" required>
                            </div>

                            <div class="col-md-12" style="margin-top: 1em;">
                                <label for="lbl_password" class="form-label"><b>Password</b></label>
                                <input type="password" name="txt_password" id="txt_password" class="form-control" placeholder="pass.123" required>
                            </div>

                            <div class="col-md-12" style="margin-top: 1em;">
                                <label for="lbl_confPassword" class="form-label"><b>Confirmar Password</b></label>
                                <input type="password" name="txt_confPassword" id="txt_confPassword" class="form-control" placeholder="pass.123" required>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: 3em;">
                            <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Crear una cuenta">
                            <a href="./" class="btn btn-warning">Regresar</a>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
            <div class="col-md-6" style="background-color: white;">
                <div align="center">
                    <img src="imgs/logoClinica.png" alt="Clinica Privada" height="96%" width="96%">
                </div>
            </div>
        </div>
    </div>
    <?php

    if (isset($_POST["btn_agregar"])) {

        $txt_password = utf8_decode($_POST["txt_password"]);
        $txt_confPassword = utf8_decode($_POST["txt_confPassword"]);

        if ($txt_password == $txt_confPassword) {
            include 'controllers/usuarios/registrarUsuario.php';

        } else {
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
            <script LANGUAGE="javascript">
                $(document).ready(function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Lo sentimos',
                        text: 'Las contraseñas ingresadas no son iguales, inténtelo de nuevo',
                        backdrop: `
                            rgba(0,170,228,0.4)
                            url("https://sweetalert2.github.io/images/nyan-cat.gif")
                            left top
                            no-repeat
                        `
                    })

                });
            </script>
            <?php
        }
    }
    ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>