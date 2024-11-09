<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobilenum = $_POST['mobilenum'];
        $role = $_POST['role'];
        $eid = $_GET['editid'];

        // Actualiza la consulta para tbladmin
        $query = mysqli_query($con, "UPDATE tbladmin SET UserName='$username', Email='$email', MobileNumber='$mobilenum', Role='$role' WHERE ID='$eid'");
        if ($query) {
            $msg = "Información de Usuario Actualizada Satisfactoriamente.";
        } else {
            $msg = "Algo salió mal. Inténtalo de nuevo.";
        }
    }

    // Opción para eliminar
    if (isset($_POST['delete'])) {
        $eid = $_GET['editid'];
        $del_query = mysqli_query($con, "DELETE FROM tbladmin WHERE ID='$eid'");
        if ($del_query) {
            $msg = "Usuario Eliminado Satisfactoriamente.";
            // Redirigir después de eliminar
            header('location:view_users.php'); // Cambia 'manage-users.php' al archivo que maneja la lista de usuarios
            exit();
        } else {
            $msg = "Algo salió mal. No se pudo eliminar el usuario.";
        }
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Editar Usuario</title>
    <script type="application/x-javascript">
        addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!-- webfonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!-- //webfonts -->
    <!-- animate -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //end-animate -->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!-- //Metis Menu -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- left-fixed-navigation -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- header-starts -->
        <?php include_once('includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Editar Información de Usuario</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Actualizar Información de Usuario:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) { echo $msg; } ?> </p>
                                <?php
                                $uid = $_GET['editid'];
                                $ret = mysqli_query($con, "SELECT * FROM tbladmin WHERE ID='$uid'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <div class="form-group">
                                        <label for="username">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['UserName']; ?>" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $row['Email']; ?>" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobilenum">Número de Móvil</label>
                                        <input type="text" id="mobilenum" name="mobilenum" class="form-control" value="<?php echo $row['MobileNumber']; ?>" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Rol</label>
                                        <select name="role" id="role" class="form-control" required="true">
                                            <option value="admin" <?php if ($row['Role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                            <option value="recepcionista" <?php if ($row['Role'] == 'recepcionista') echo 'selected'; ?>>Recepcionista</option>
                                            <option value="Cliente" <?php if ($row['Role'] == 'Cliente') echo 'selected'; ?>>Cliente</option>
                                        </select>
                                    </div>
                                <?php } ?>
                                <button type="submit" name="submit" class="btn btn-default">Actualizar Información Usuario</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
        <!-- Classie -->
        <script src="js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
                showLeftPush = document.getElementById('showLeftPush'),
                body = document.body;

            showLeftPush.onclick = function () {
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
        <!-- scrolling js -->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"> </script>
    </div>
</body>
</html>
<?php } ?>
