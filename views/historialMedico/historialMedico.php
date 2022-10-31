<?php
	ob_start();
	require_once '../../controllers/conexion.php';


	//PACIENTES
	$db_conexionHPaciente = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
    $idEdit = utf8_decode($_GET["id"]);
	$db_conexionHPaciente->real_query("SELECT hm.id_paciente as id, p.nombres AS nombrePaciente, e.nombres AS nombreMedico, hm.observaciones FROM clinicaproyecto_2021.historial_medico 
										AS hm INNER JOIN clinicaproyecto_2021.pacientes AS p ON hm.id_paciente = p.id_paciente INNER JOIN clinicaproyecto_2021.empleados AS 
										e ON hm.id_empleado = e.id_empleado WHERE hm.id_paciente = $idEdit;");
	$resultadoP = $db_conexionHPaciente->use_result();

	//NOMBRE
	$db_conexionHN = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre,$port);
    $idEditN = utf8_decode($_GET["id"]);
	$db_conexionHN->real_query("SELECT hm.id_paciente as id, p.nombres AS nombrePaciente, e.nombres AS nombreMedico, hm.observaciones FROM clinicaproyecto_2021.historial_medico 
										AS hm INNER JOIN clinicaproyecto_2021.pacientes AS p ON hm.id_paciente = p.id_paciente INNER JOIN clinicaproyecto_2021.empleados AS 
										e ON hm.id_empleado = e.id_empleado WHERE hm.id_paciente = $idEditN;");
	$resultadoPN = $db_conexionHN->use_result();
	$filaDCEditN = $resultadoPN->fetch_assoc();

?>

<!doctype html>
<html lang="en">
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
<head>
	<title>Historial Medico Paciente</title>
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
            <h3 class="text-center">Historial Medico de: <br> <?php echo $filaDCEditN['nombrePaciente']; ?></h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
                <input type="hidden" name="id" id="id" value="<?php echo $filaDCEditN['id']; ?>">
				<?php while ($filaDCEdit = $resultadoP->fetch_assoc()) { ?>
                <div class="row">
                    <div class="col-md-6">
                        
                        <label for="lbl_medico" class="form-label"><b>Medico que atendió:</b></label>
                        <input type="text" name="txt_medico" id="txt_medico" class="form-control" value="<?php echo "Doc. "; echo $filaDCEdit['nombreMedico']; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="lbl_observaciones" class="form-label"><b>Observaciones</b></label>
                        <textarea class="form-control" name="txt_observaciones" id="txt_observaciones" rows="3" disabled> <?php echo $filaDCEdit['observaciones']; ?> </textarea>
                    </div>
                </div>
                <?php } $db_conexionHPaciente->close(); ?>
                
                <div style="margin-top: 1em;">
                    <a href="../paciente/paciente.php" class="btn btn-success">Regresar</a> &nbsp;&nbsp;
                    <a href="../paciente/agregarMedicamento.php?id=<?php echo $filaDCEditN['id']; ?>"  class='btn btn-success'>Agregar Otro Medicamento</a>
                </div>
            </form>
        </div>
    </div>
    <?php $db_conexionHN->close(); ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>