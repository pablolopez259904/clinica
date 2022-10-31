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
    include '../../controllers/conexion.php';

    $db_conexionEditM = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $idEdit = utf8_decode($_GET["id"]);
    $db_conexionEditM -> real_query("SELECT m.id_medicamento AS id,m.nombre,m.marca,m.descripcion,lm.nombre as nombreLote,m.precio_costo,m.precio_venta,m.cantidad FROM clinicaproyecto_2021.medicamento AS m INNER JOIN clinicaproyecto_2021.lotes_medicina AS lm ON m.id_lote_medicina = lm.id_lote_medicina WHERE id_medicamento = $idEdit;");
    $resultadoEditM = $db_conexionEditM -> use_result();
    $filaMedicamentoEdit = $resultadoEditM -> fetch_assoc();


    $db_conexionIdEdit = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
    $db_conexionIdEdit->real_query("SELECT id_lote_medicina AS id, nombre AS nombreLote FROM clinicaproyecto_2021.lotes_medicina;");
    $resultadoIdEdit = $db_conexionIdEdit->use_result();
    $idLoteM = $resultadoIdEdit->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Editar Medicamento</title>
    <link rel="shortcut icon" href="imgs\titleUsuarios.png" />

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<?php include '../cabecera.php'; ?>

<body background="../imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
    <br>
    <div class="col-md-8" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h1 class="text-center">Editar Medicamento</h1>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">


    <div class="container">
        <form class="d-flex" action="" method="POST" autocomplete="off">
            <div class="col">

                <input type="hidden" name="id" id="id" value="<?php echo $filaMedicamentoEdit['id']; ?>">
                <div class="mb-3">
                    <label for="lbl_nombre" class="form-label"><b>Nombre</b></label>
                    <input type="text" name="txt_nombre" id="txt_nombre" class="form-control" value="<?php echo $filaMedicamentoEdit['nombre']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_marca" class="form-label"><b>Marca</b></label>
                    <input type="text" name="txt_marca" id="txt_marca" class="form-control" value="<?php echo $filaMedicamentoEdit['marca']; ?>">
                </div>
    
                <div class="mb-3">
                    <label for="lbl_lote" class="form-label"><b>Lote Medicamento</b></label>
                    <select class="form-select" name="drop_lote" id="drop_lote" required>
                        <option value="<?php echo $idLoteM['id']; ?>"><?php echo $idLoteM['nombreLote']; ?></option>
                        <?php
                        while ($filaId = $resultadoIdEdit->fetch_assoc()) {
                            echo "<option value=" . $filaId['id'] . ">" . $filaId['nombreLote'] . "</option>";
                        }
                        $db_conexionIdEdit->close();
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
                    <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="3"><?php echo $filaMedicamentoEdit['descripcion']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="lbl_costo" class="form-label"><b>Precio de Costo (Q)</b></label>
                    <input type="number" step="0.01" name="txt_costo" id="txt_costo" class="form-control" value="<?php echo $filaMedicamentoEdit['precio_costo']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_venta" class="form-label"><b>Precio de Venta (Q)</b></label>
                    <input type="number" step="0.01" name="txt_venta" id="txt_venta" class="form-control" value="<?php echo $filaMedicamentoEdit['precio_venta']; ?>">
                </div>

                <div class="mb-3">
                    <label for="lbl_cantidad" class="form-label"><b>Unidades</b></label>
                    <input type="number" name="txt_cantidad" id="txt_cantidad" class="form-control" value="<?php echo $filaMedicamentoEdit['cantidad']; ?>">
                </div>

                <?php $db_conexionEditM->close(); ?>

                <div class="mb-3">
                    <a href="../medicamento/medicamento.php" class="btn btn-info">Regresar</a> &nbsp;&nbsp;
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-success" value="Editar">
                </div>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST["btn_editar"])) {
        include '../../controllers/medicamento/editmedicamento.php';
    }

    ?>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>