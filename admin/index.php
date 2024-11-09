<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $adminuser = mysqli_real_escape_string($con, $_POST['username']);
    $password = hash('sha512',$_POST['password']);
    
    // Verificar el login y el rol
    $query = mysqli_query($con, "SELECT ID, Role FROM tbladmin WHERE UserName='$adminuser' AND Password='$password'");
    $ret = mysqli_fetch_array($query);
    
    if ($ret > 0) {
        $_SESSION['bpmsaid'] = $ret['ID'];
        $_SESSION['userRole'] = $ret['Role'];
        
        header('location:dashboard.php');
        exit();
    } else {
        $msg = "Información Inválida.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Admin</title>
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
    <div class="hero-wrap hero-wrap-2" style="" data-stellar-background-ratio="0.5">
        <div class="container">
            <!-- Contenido de la sección -->
            <h1 class="text-center"></h1>
        </div>
    </div>
<body class="cbp-spmenu-push">
    <div class="hero-wrap hero-wrap-2" style="background-image: url('../images/image_3.jpg');" data-stellar-background-ratio="0.5">
        <div class="main-content">
    <div class="main-content">
        <div id="">
            <br>
            <div class="main-page login-page">
                <div class="widget-shadow">
                    <div class="login-top">
                    <h3 class="title1">Pagina de Acceso</h3>
                        <h4>Bienvenid@ a tu Sistema Administrativo!</h4>
                    </div>
                    <div class="login-body">
                        <form role="form" method="post" action="">
                            
                            </p>
                            <input type="text" class="user" name="username" placeholder="Usuario" required="true">
                            <input type="password" name="password" class="lock" placeholder="Contraseña" required="true">
                            <input type="submit" name="login" value="Acceder">
                            <div class="forgot-grid">
                                <!-- Opción para volver al inicio -->
                                <div class="forgot">
                                    <a href="../index.php">Volver al Inicio</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="forgot-grid">
                                <!-- Opción para crear una nueva cuenta -->
                                <div class="forgot">
                                    <a href="register.php">Crear nueva cuenta</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="forgot-grid">
                                <!-- Opción de recuperar contraseña -->
                                <div class="forgot">
                                    <a href="forgot-password.php">¿Olvidaste tu contraseña?</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
    <br><br><br>   <br><br><br>   <br><br><br>
</body>

</html>
