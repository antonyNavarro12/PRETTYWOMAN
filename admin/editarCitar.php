<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/dbconnection.php');

if (!$con) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar si el usuario está logueado
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Obtener el ID de la cita de la URL
    $appointmentId = isset($_GET['editid']) ? intval($_GET['editid']) : 0;

    // Obtener los datos actuales de la cita para mostrarlos en el formulario
    $query = mysqli_query($con, "SELECT * FROM tblappointment WHERE ID = $appointmentId");
    $appointmentData = mysqli_fetch_array($query);

    if (!$appointmentData) {
        echo "<script>alert('Cita no encontrada.'); window.location.href='search-appointment.php';</script>";
        exit();
    }

    // Actualizar la cita cuando se envíe el formulario
    if (isset($_POST['submit'])) {
        $customerName = mysqli_real_escape_string($con, $_POST['Name']);
        $appointmentDate = mysqli_real_escape_string($con, $_POST['AptDate']);
        $service = mysqli_real_escape_string($con, $_POST['service']);
        $appointmentTime = mysqli_real_escape_string($con, $_POST['AptTime']);
        $PhoneNumber = mysqli_real_escape_string($con, $_POST['PhoneNumber']);

        // Actualizar la cita en la base de datos
        $updateQuery = "UPDATE tblappointment SET 
                        Name='$customerName', 
                        AptDate='$appointmentDate', 
                        Services='$service', 
                        AptTime='$appointmentTime', 
                        PhoneNumber='$PhoneNumber' 
                        WHERE ID=$appointmentId";

        if (mysqli_query($con, $updateQuery)) {
            echo "<script>alert('Cita actualizada exitosamente.'); window.location.href='search-appointment.php';</script>";
        } else {
            $msg = "Error al actualizar la cita: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Editar Cita</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
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
                    <h3 class="title1">Editar Cita</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Formulario de Edición de Cita:</h4>
                        </div>
                        <div class="form-body">
                            <!-- Formulario para editar la cita -->
                            <form method="post">
                                <div class="form-group">
                                    <label for="Name">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $appointmentData['Name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="AptDate">Fecha de la Cita</label>
                                    <input type="date" class="form-control" id="AptDate" name="AptDate" value="<?php echo $appointmentData['AptDate']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="AptTime">Hora de la Cita</label>
                                    <input type="time" class="form-control" id="AptTime" name="AptTime" value="<?php echo $appointmentData['AptTime']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="PhoneNumber">Número de Teléfono</label>
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo $appointmentData['PhoneNumber']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="service">Servicio</label>
                                    <select class="form-control" id="service" name="service" required>
                                        <option value="">Seleccionar Servicio</option>
                                        <?php
                                        $serviceQuery = mysqli_query($con, "SELECT * FROM tblservices");
                                        while ($row = mysqli_fetch_array($serviceQuery)) {
                                            $selected = $appointmentData['Services'] == $row['ServiceName'] ? 'selected' : '';
                                            echo '<option value="' . $row['ServiceName'] . '" ' . $selected . '>' . $row['ServiceName'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Guardar Cambios</button>
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
<?php } ?>
