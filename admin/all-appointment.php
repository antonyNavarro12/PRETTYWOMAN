<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Todas las Citas</title>

<script type="application/x-javascript"> 
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
    function hideURLbar(){ window.scrollTo(0,1); } 
</script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!-- Web fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!-- animate -->
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
    <div class="main-content">
        <!-- Left-fixed-navigation -->
        <?php include_once('includes/sidebar.php');?>
        
        <!-- Header -->
        <?php include_once('includes/header.php');?>

        <!-- Main content start -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Todas las Citas</h3>
                    
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Todas las Citas:</h4>
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Número de Cita</th> 
                                    <th>Nombre Cliente</th>
                                    <th>Número Celular</th> 
                                    <th>Fecha de Cita</th>
                                    <th>Hora de Cita</th>
                                    <th>Acción</th> 
                                </tr> 
                            </thead> 
                            <tbody>
<?php
$ret = mysqli_query($con, "select * from tblappointment");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
                                <tr> 
                                    <th scope="row"><?php echo $cnt; ?></th> 
                                    <td><?php echo $row['AptNumber']; ?></td> 
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['PhoneNumber']; ?></td>
                                    <td><?php echo $row['AptDate']; ?></td> 
                                    <td><?php echo $row['AptTime']; ?></td> 
                                    <td>
                                        <a href="view-appointment.php?viewid=<?php echo $row['ID']; ?>">Detalle</a> | 
                                        <a href="delete-appointment.php?delid=<?php echo $row['ID']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">Eliminar</a>
                                    </td> 
                                </tr> 
<?php 
    $cnt = $cnt + 1;
} 
?>
                            </tbody> 
                        </table> 
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
    </div>
    
    <!-- Scripts -->
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
    
    <!-- Scrolling js -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
