<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="imgs/24.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Citas</title>
    <meta name="theme-color" content="#F0DB4F">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" type="image/png" href="./img/ProgramadorFitness.png">
    <link rel="apple-touch-icon" href="./ProgramadorFitness.png">
    <link rel="apple-touch-startup-image" href="./ProgramadorFitness.png">
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body background="imgs/fondoUsuarios.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
    <div class="col-md-8" style="margin-left: 50px;">
        <div style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
            <h3 class="text-center">Ingresa los datos de tu cita</h3>
        </div>
        <div style="padding:10px; background-color: white; width: 100%;">
            <form action="" method="POST">
				<h3><b><i><u>DATOS DEL PACIENTE</u></i></b></h3>
				    <div class="row" style="margin-top: 1em;">
                        <div class="col-md-6">
                            <span><b>Nombres</b></span>
                            <input class="form-control" type="text" name="txt_nombres" id="txt_nombres" placeholder="Nombre1 Nombre2" required>
                        </div>
                        <div class="col-md-6">
                            <span><b>Apellidos</b></span>
                            <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" placeholder="Apellido1 Apellido2" required>
                        </div>
                    </div>
				    <div class="row" style="margin-top: 1em;">
                        <div class="col-md-6">
                            <span><b>Fecha Nacimiento</b></span>
                            <input class="form-control" type="date" name="txt_fn" id="txt_fn" placeholder="dd-MM-yyyy" required>
                        </div>
                    <div class="col-md-6">
                        <span><b>Telefono</b></span>
                        <input class="form-control" type="number" name="txt_telefono" id="txt_telefono" placeholder="12345678" required>
                    </div>
                </div>
				<div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Direccion</b></span>
                        <input class="form-control" type="text" name="txt_direccion" id="txt_direccion" placeholder="Ciudad, Casa No.#, Depto." required>
                    </div>
                    <div class="col-md-6">
                        <span><b>Email</b></span>
                        <input class="form-control" type="text" name="txt_email" id="txt_email" placeholder="ejemplo@gmail.com" required>
                    </div>
                </div>
                <br><br>
				<hr size=6>
				<h3><b><i><u>DATOS DE LA CITA</u></i></b></h3>
                <div class="row">
                    <div class="col-md-6">
                        <label for="lbl_rama" class="form-label"><b>Rama Medica</b></label>
                        <select class="form-select" name="drop_rama" id="drop_rama" required>
                            <option value=0>--Seleccione la rama--</option>
                            <option value=1>Pediatria</option>
                            <option value=2>Dermatologia</option>
                        </select>
                    </div>	
                </div>
                <div class="row" style="margin-top: 1em;">
                    <div class="col-md-6">
                        <span><b>Sintomas</b></span>
						<textarea class="form-control" name="txt_sintomas" id="txt_sintomas" rows="3" placeholder="Descripcion de lo que tiene/siente el paciente..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <span><b>Fecha y hora a solicitar</b></span>
                        <input class="form-control" type="datetime-local" name="txt_fecha_hora" id="txt_fecha_hora" placeholder="Fecha y Hora" required>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 1em;">
                    <button type="button" class="btn btn-primary" id="btn_agregar" name="btn_agregar">Solicitar cita</button>
                    <?php
                    ?>
                </div>
            </form>

            <div id="resultado"></div>


            <script src="script.js"></script>
            
            <script>
                window.addEventListener('load', () => {
                    let baseDatos;
                    let solicitudConexion = indexedDB.open('citasBD', 1);

                    solicitudConexion = function(evento){
                        baseDatos = evento.target.result;
                    }

                    solicitudConexion.onerror = function(evento){
                        document.querySelector('#resultado').innerText = 'Error al conectar la base de datos: ${evento.target.errorCode}';
                    }

                    solicitudConexion.onupgradeneeded = function(evento){
                        baseDatos = event.target.result;
                        let citas = baseDatos.createObjectStore('citas',{autoIncrement: true});
                    }

                    document.querySelector('#btn_agregar').addEventListener('click', function(evento){
                        let txt_nombres = document.querySelector('#txt_nombres').value;
                        let txt_apellidos = document.querySelector('#txt_apellidos').value;
                        let txt_fn = document.querySelector('#txt_fn').value;
                        let txt_telefono = document.querySelector('#txt_telefono').value;
                        let txt_direccion = document.querySelector('#txt_direccion').value;
                        let txt_email = document.querySelector('#txt_email').value;
                        let drop_rama = document.querySelector('#drop_rama').value;
                        let txt_sintomas = document.querySelector('#txt_sintomas').value;
                        let txt_fecha_hora = document.querySelector('#txt_fecha_hora').value;
                        let transaccion = baseDatos.transaction(['citas'], 'readwrite');    
                        let citas = transaccion.objectStore('citas');
                        let cita = {nombres: txt_nombres, 
                                    apellidos: txt_apellidos, 
                                    fechaNacimiento: txt_fn,
                                    telefono: txt_telefono,
                                    direccion: txt_direccion,
                                    correo: txt_email,
                                    rama: drop_rama,
                                    sintomas: txt_sintomas,
                                    fechaHora: txt_fecha_hora
                                    };
                        
                        citas.add(cita);
                        transaccion.oncomplete = function(){
                            document.querySelector('#resultado').innerText = 'La cita se ha creado';
                        }

                        transaccion.onerror = function(evento){
                            document.querySelector('#resultado').innerText = 'Error al almacenar: ${evento.target.errorCode}';
                        }

                    });
                    

                }); 
            </script>
</body>
</html>
