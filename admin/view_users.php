<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Eliminar usuario
    if (isset($_GET['delid'])) {
        $delid = intval($_GET['delid']);
        $query = mysqli_query($con, "DELETE FROM tblusers WHERE ID='$delid'");

        if ($query) {
            echo "<script>alert('Usuario eliminado correctamente.');</script>";
            echo "<script>window.location.href='views/users.php';</script>"; // Ajusta la ruta aquí
        } else {
            echo "<script>alert('Error al eliminar el usuario: " . mysqli_error($con) . "');</script>";
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title> Lista de Usuarios</title>
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Lista de Usuarios</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Lista de Usuarios:</h4>
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Nombre de Usuario</th> 
                                    <th>Número Móvil</th> 
                                    <th>Correo Electrónico</th>
                                    <th>Rol</th>
                                    <th>Acción</th> 
                                </tr> 
                            </thead> 
                            <tbody>
<?php
$ret = mysqli_query($con, "SELECT * FROM tbladmin");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
                                <tr> 
                                    <th scope="row"><?php echo $cnt; ?></th> 
                                    <td><?php echo $row['AdminName']; ?></td> 
                                    <td><?php echo $row['MobileNumber']; ?></td> 
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['Role']; ?></td> 
                                    <td>
    <a href="edit-user.php?editid=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm">Editar</a> 
    <a href="delete-user.php?delid=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este usuario?');">Eliminar</a>
</td>

                                </tr>
<?php 
    $cnt++;
} ?>
                            </tbody> 
                        </table> 
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="js/classie.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>
