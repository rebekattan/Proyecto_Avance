<?php 
	$alert = '';
	session_start();
	if (!empty($_POST)) {
		if (empty($_POST['nombreusu']) || empty($_POST['password'])) {
			$alert= 'Ingrese su usuario y su clave';

			require_once('Conexion.php');
			$sql=new connection();
			$conexion=$sql->get_connection();

			$statement=$conexion->prepare("CALL paDatosVacios()");
			$statement->execute();
			mysqli_close($conexion);

		}else{
			require_once "Conexion.php";
			$sql=new connection();
			$conexion=$sql->get_connection();

			$nombreusu=$_POST['nombreusu'];
			$password=$_POST['password'];

			$query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE nombreUsu='$nombreusu' AND passwordUsu='$password'");
			mysqli_close($conexion);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				$data = mysqli_fetch_array($query);
				
				$_SESSION['active']= true;
				$_SESSION['codUsu']= $data['codUsu'];
				$_SESSION['nombreUsu']= $data['nombreUsu'];
				$_SESSION['nombre']= $data['nombre'];
				$_SESSION['apellido']= $data['apellido'];
				$_SESSION['passwordUsu']= $data['passwordUsu'];
				$_SESSION['codRol']= $data['codRol'];

				header('location: welcome.php');
			}else{
				
				$alert='Usuario o clave incorrecta';
				session_destroy();

				require_once('Conexion.php');
				$sql=new connection();
				$conexion=$sql->get_connection();

				$nombreusu=$_POST['nombreusu'];

				$statement=$conexion->prepare("CALL paDatosErroneos(?)");
				$statement->bind_param("s",$nombreusu);
				$statement->execute();
				mysqli_close($conexion);

			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <me
    ta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Propio Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">

    <title>Login</title>

</head>
<body>
	<div class="modal-dialog text-center">
		<div class="col-sm-12 main-section">
			<div class="modal-content">
				<div class="col-12 user-img">
					<img src="img/login.png">
				</div>
				<form class="col-12" action="" method="post">
					<div class="form-group">
						<input type="text" name="nombreusu" class="form-control" placeholder="Ingrese su Usuario" >
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Ingrese su contrasena">
					</div>
					<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
					<div class="col-md-12 button">
						<input type="submit" class="btn btn-warning btnAction" value="Ingresar" required="">
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
						