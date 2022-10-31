<?php
ob_start();
require_once 'conexion.php';

//MEDICAMENTO
$db_conexionMedicamento = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$idEdit = utf8_decode($_GET["id"]);
$db_conexionMedicamento->real_query("SELECT m.id_medicamento AS id,m.nombre,m.marca,m.descripcion,lm.nombre as NombreLote,m.precio_costo,m.precio_venta,m.cantidad FROM clinicaproyecto_2021.medicamento AS m INNER JOIN clinicaproyecto_2021.lotes_medicina AS lm ON m.id_lote_medicina = lm.id_lote_medicina WHERE m.id_medicamento = $idEdit;");
$resultadoM = $db_conexionMedicamento->use_result();
$filaMedicina = $resultadoM->fetch_assoc()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/popper.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/sweetalert2.min.css">

    <title>Clinica Privada</title>
</head>

<body background="img/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">

    <header>
        <div class="container">
            <div class="row align-items-stretch justify-content-between">
                <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                    <a class="navbar-brand" href="index.php">Clinica Privada</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <img src="img/cart.jpeg" class="nav-link dropdown-toggle img-fluid" height="100px" width="70px" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img>
                                <div style="overflow: auto; border: solid 3px #b8b8b8; padding: 10px; height: 600px;" id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
                                    <table id="lista-carrito" class="table">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- TABLA DE COSAS PEDIDAS CON JS -->
                                        </tbody>
                                    </table>

                                    <a href="#" id="vaciar-carrito" class="btn btn-danger btn-block">Vaciar Carrito</a>
                                    <a href="#" id="procesar-pedido" class="btn btn-success btn-block">Procesar Compra</a>
                                </div>
                            </li>
                            <div aling="center">
                                <!--<a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
                                <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar Compra</a>-->
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="pricing-header px-3 py-3 pt-md-5 mx-auto text-center">
            <br>
            <h1 class="display-4 mt-4">CLINICA PRIVADA - DESARROLLO WEB</h1>
            <p class="lead">¡Selecciona nuestros medicamentos!</p>
            <p class="lead">¡Elije tu medicina y al procesar la compra decides la cantidad de unidades!</p>
        </div>

        
        <div class="container" id="lista-productos" style="background-color: rgba(255,255,255,0.4);">
            <b>
                <font size=6 face="Times New Roman" color="Black">FARMACIA</font>
            </b>

            <div class="card-header">
                <h4 class="my-0 font-weight-bold"><?php echo $filaMedicina['nombre'] ?></h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        <img src="img/medicamento.jpg" class="card-img-top">
                        <h1 class="card-title pricing-card-title precio">Q <span class=""><?php echo $filaMedicina['precio_venta'] ?></span></h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <br><br><br><br>
                    <ul>
                        <li><b>Nombre: </b><?php echo $filaMedicina['nombre'] ?></li><br>
                        <li><b>Marca: </b><?php echo $filaMedicina['marca'] ?></li><br>
                        <li><b>Descripción: </b><?php echo $filaMedicina['descripcion'] ?></li><br>
                        <li><b>Existencias: </b> <font color="#03A700" face="Arial Black"> <?php echo $filaMedicina['cantidad'] ?> </font> </li><br>
                    </ul>
                    <hr>
                    <div class="text-center">
                        <!--NECESARIO POR LA ESTRUCTURA DEL JS: CARRITO.JS-->
                        <div class="container" id="lista-productos" hidden>
                            <b> <font size=7 face="Times New Roman" color="Black">FARMACIA</font> </b><br>
                            <div class="row">
                                <div class="col-md-4" style="margin-top: 2em;">
                                    <div class="card-header">
                                        <h4 class="my-0 font-weight-bold"><?php echo $filaMedicina['nombre'] ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <img src="img/medicamento.jpg" class="card-img-top">
                                        <h1 class="card-title pricing-card-title precio">Q <span class=""><?php echo $filaMedicina['precio_venta'] ?></span></h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li></li>
                                            <li><?php echo $filaMedicina['descripcion'] ?></li>
                                        </ul>
                                        <a href="" class="btn btn-block btn-primary agregar-carrito" data-id=<?php echo $filaMedicina['id'] ?>>Comprar</a>
                                        <a href="detalleProducto.php?id=<?php echo $filaMedicina['id'] ?>" class="btn btn-block btn-success">Detalles</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--NECESARIO POR LA ESTRUCTURA DEL JS: CARRITO.JS-->
                        <br><br><br>
                        <a href="" class="btn btn-block btn-primary agregar-carrito" data-id=<?php echo $filaMedicina['id'] ?>>Comprar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="background-color: rgba(255,255,255,0.4);">
            <a href="index.php" class="btn btn-block btn-success"><font size=5 face="Arial Black"> Regresar </font></a>
            <br>
        </div>
        
    </main>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/carrito.js"></script>
    <script src="js/pedido.js"></script>
    <script src="js/redireccionar.js"></script>

</body>

</html>