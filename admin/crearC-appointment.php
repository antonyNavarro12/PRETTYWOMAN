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
        $customerName = isset($_POST['Name']) ? mysqli_real_escape_string($con, $_POST['Name']) : '';
        $appointmentDate = isset($_POST['AptDate']) ? mysqli_real_escape_string($con, $_POST['AptDate']) : '';
        $service = isset($_POST['service']) ? mysqli_real_escape_string($con, $_POST['service']) : '';
        $appointmentTime = isset($_POST['AptTime']) ? mysqli_real_escape_string($con, $_POST['AptTime']) : '';
        $PhoneNumber = isset($_POST['PhoneNumber']) ? mysqli_real_escape_string($con, $_POST['PhoneNumber']) : '';
        $aptnumber = mt_rand(100000000, 999999999);

        // Horario de apertura y cierre
        $openingTime = '08:00';
        $closingTime = '18:30';

        // Validación de campos
        if (empty($customerName) || empty($appointmentDate) || empty($service) || empty($appointmentTime) || empty($PhoneNumber)) {
            $msg = "Todos los campos son obligatorios.";
        } elseif ($appointmentTime < $openingTime || $appointmentTime > $closingTime) {
            // Verificar si la hora de la cita está fuera del horario de apertura y cierre
            echo "<script>alert('Hora de atención no disponible. El horario de atención es de $openingTime a $closingTime.');</script>";
        } else {
            // Verificar si ya existe una cita a la misma fecha y hora
            $checkQuery = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptDate='$appointmentDate' AND AptTime='$appointmentTime'");
            if (mysqli_num_rows($checkQuery) > 0) {
                $msg = "Hora no disponible. Ya existe una cita programada a esa hora.";
            } else {
                // Insertar la nueva cita si la hora está disponible
                $query = mysqli_query($con, "INSERT INTO tblappointment (Name, AptDate, Services, AptTime, AptNumber, PhoneNumber) 
                                             VALUES ('$customerName', '$appointmentDate', '$service', '$appointmentTime', '$aptnumber', '$PhoneNumber')");

                if (!$query) {
                    die("Error en la consulta: " . mysqli_error($con));
                } else {
                    $lastId = mysqli_insert_id($con);
                    $result = mysqli_query($con, "SELECT AptNumber FROM tblappointment WHERE id = $lastId");
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['aptno'] = $row['AptNumber'];
                    }
                    echo "<script>alert('Cita creada exitosamente. Número de cita: " . $_SESSION['aptno'] . "');</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title> Crear Cita</title>
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
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Crear Cita</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Formulario de Creación de Cita:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group"> 
                                    <label for="Name">Nombre del Cliente</label> 
                                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nombre Completo del cliente" required="true"> 
                                </div> 
                                <div class="form-group"> 
                                    <label for="AptDate">Fecha de la Cita</label> 
                                    <input type="date" class="form-control" id="AptDate" name="AptDate" required="true"> 
                                </div> 
                                <div class="form-group"> 
                                    <label for="AptTime">Hora de la Cita</label> 
                                    <input type="time" class="form-control" id="AptTime" name="AptTime" required="true"> 
                                </div> 
                                <div class="form-group">
                                    <label for="PhoneNumber">Número de Teléfono</label>
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required="true">
                                </div>
                                <div class="form-group"> 
                                    <label for="service">Servicio</label>
                                    <select class="form-control" id="service" name="service" required="true">
                                        <option value="">Seleccionar Servicio</option>
                                        <?php 
                                        $serviceQuery = mysqli_query($con, "SELECT * FROM tblservices");
                                        while ($row = mysqli_fetch_array($serviceQuery)) {
                                            echo '<option value="' . $row['ServiceName'] . '">' . $row['ServiceName'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">Crear Cita</button> 
                            </form>
                            <?php if (isset($msg)) { echo "<p style='color:red;'>$msg</p>"; } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/classie.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php  ?>
