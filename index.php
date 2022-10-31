<?php 
    session_start();
	session_destroy();
?>

<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="imgs\titleLogin.png"/>
	<link rel="stylesheet" type="text/css" href="Estilo/util.css">
	<link rel="stylesheet" type="text/css" href="Estilo/principal.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<div class="limiter">
		<div class="container-loginteam">
			<div class="wrap-loginteam">
				<div class="loginteam-pic js-tilt" data-tilt>
					<img src="imgs/usuario1.png" alt="IMG">
					<span class="loginteam-form-title">
						Iniciar sesión
					</span>
					
					
				</div>

				<form class="loginteam-form validate-form" action="" method="POST">
					<span class="loginteam-form-title">
						Clinica - Grupo #4
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" id="email" placeholder="Correo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" id="password" placeholder="Contraseña" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="container-loginteam-form-btn">
						<input type="submit" name="btn_ingresar" id="btn_ingresar" class="loginteam-form-btn" value="Ingresar">
					</div>

					<div class="text-center p-t-100">
						<a class="txt2" href="registerUser.php">
							Crear una cuenta
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php
		
		if(isset($_POST["btn_ingresar"])){
			include 'views/login/login.php';
		}

	?>
</body>
</html>