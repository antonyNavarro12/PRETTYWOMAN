<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/dbconnection.php');

// Verificar conexión a la base de datos
if (!$con) {
    die("Error en la conexión: " . mysqli_connect_error());
}

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminname = mysqli_real_escape_string($con, $_POST['adminname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $usermobile = mysqli_real_escape_string($con, $_POST['usermobile']);
        $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
        $password = hash('sha512',$_POST['password']);
        $role = mysqli_real_escape_string($con, $_POST['Role']); // Cambiar a minúsculas

        // Consulta SQL para insertar los datos, incluido el rol, en la tabla tblusers
        $query = mysqli_query($con, "INSERT INTO tbladmin (AdminName, UserName, MobileNumber, Email, Password, Role) VALUES ('$adminname', '$username', '$usermobile', '$useremail', '$password', '$role')");

        if (!$query) {
            die("Error en la consulta: " . mysqli_error($con)); // Muestra el error en la consulta SQL
        } else {
            echo "<script>alert('Usuario agregado exitosamente');</script>";
            // Redirigir a otra página si es necesario
            // header('location: users.php');
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title> Crear Usuario</title>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include_once('includes/sidebar.php');?>
		<!-- header-starts -->
		<?php include_once('includes/header.php');?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h3 class="title1">Crear Usuario</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Formulario de Creación de Usuario:</h4>
						</div>
						<div class="form-body">
							<form method="post">
							<div class="form-group"> 
									<label for="adminname">Nombre Completo de Usuario</label> 
									<input type="text" class="form-control" id="adminname" name="adminname" placeholder="Nombre Completo del usuario" required="true"> 
								</div> 
								<div class="form-group"> 
									<label for="username">Usuario</label> 
									<input type="text" class="form-control" id="username" name="username" placeholder="usuario" required="true"> 
								</div> 
								<div class="form-group"> 
									<label for="usermobile">Número Móvil</label> 
									<input type="text" class="form-control" id="usermobile" name="usermobile" placeholder="Número de móvil" required="true" maxlength="8" pattern="[0-9]{8}"> 
								</div> 
								<div class="form-group"> 
									<label for="useremail">Correo Electrónico</label> 
									<input type="email" class="form-control" id="useremail" name="useremail" placeholder="Correo electrónico" required="true"> 
								</div> 
								<div class="form-group"> 
									<label for="password">Contraseña</label> 
									<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required="true"> 
								</div> 
								<div class="form-group"> 
									<label for="Role">Rol</label>
									<select class="form-control" id="Role" name="Role" required="true">
										<option value="">Seleccionar Rol</option>
										<option value="admin">Administrador</option>
										<option value="recepcionista">Recepcionista</option>										
									</select>
								</div>
								<button type="submit" name="submit" class="btn btn-default">Agregar Usuario</button> 
							</form> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		<?php include_once('includes/footer.php');?>
		<!--//footer-->
	</div>
	<!-- Classie -->
	<script src="js/classie.js"></script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>
