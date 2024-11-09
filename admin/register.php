<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Lógica para crear un nuevo usuario con rol de Cliente
if (isset($_POST['register'])) {
    $admin_name = mysqli_real_escape_string($con, $_POST['adminname']);
    $user_name = mysqli_real_escape_string($con, $_POST['username']);
    $mobile_number = mysqli_real_escape_string($con, $_POST['mobilenumber']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = hash('sha512',$_POST['password']);  // Encriptamos la contraseña
    $role = 'Cliente';  // Asignamos el rol de "Cliente"
    
    // Verificar si el nombre de usuario o el correo electrónico ya existen
    $check_user_query = mysqli_query($con, "SELECT * FROM tbladmin WHERE UserName='$user_name' OR Email='$email'");
    $user_exists = mysqli_fetch_array($check_user_query);
    
    if ($user_exists > 0) {
        $msg = "El nombre de usuario o el correo electrónico ya existen.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $query = mysqli_query($con, "INSERT INTO tbladmin(AdminName, UserName, MobileNumber, Email, Password, Role) 
            VALUES('$admin_name', '$user_name', '$mobile_number', '$email', '$password', '$role')");
        if ($query) {
            $msg = "Cuenta creada con éxito. Ahora puedes iniciar sesión.";
        } else {
            $msg = "Error al crear la cuenta.";
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title> Crear Cuenta</title>
    <script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Font CSS -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- jQuery -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!-- Webfonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!-- Animate CSS -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
<div class="hero-wrap hero-wrap-2" style="background-image: url('../images/image_4.jpg');" data-stellar-background-ratio="0.5">
<div class="main-content">
    <div class="main-content">
        <div id="">
            <br>
            <div class="main-page login-page">
                <h3 class="title1"></h3>
                <div class="widget-shadow">
                    <div class="login-top">
                    
                    <h3 class="title1">CREAR NUEVA CUENTA</h3>
                        <h4>Completa los detalles para crear una cuenta!</h4>
                    </div>
                    <div class="login-body">
                        <form role="form" method="post" action="">
                            <p style="font-size:16px; color:red" align="center"> 
                                <?php if (isset($msg)) { echo $msg; } ?> 
                            </p>
                            <input type="text" class="user" name="adminname" placeholder="Nombre Completo" required="true">
                            <input type="text" class="user" name="username" placeholder="Nombre de Usuario" required="true">
                            <input type="text" class="user" name="mobilenumber" placeholder="Número de Móvil" required="true">
                            <input type="text" class="user" name="email" placeholder="Correo Electrónico" required="true">
                            <input type="password" name="password" class="lock" placeholder="Contraseña" required="true">
                            <input type="submit" name="register" value="Registrar">
                        </form>
                        <div class="forgot">
                                    <a href="../admin/index.php">Volver al Login</a>
                                </div>
                                <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/classie.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
    <br><br><br>   <br><br><br>   <br><br><br>
</body>
</html>
