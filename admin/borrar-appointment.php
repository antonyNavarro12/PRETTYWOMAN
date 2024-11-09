<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['delete'])) {
    $appointment_id = $_POST['appointment_id'];

    $query = mysqli_query($con, "DELETE FROM tblappointments WHERE id='$appointment_id'");

    if ($query) {
        $msg = "Cita eliminada con éxito.";
    } else {
        $msg = "Error al eliminar la cita.";
    }
}

// Obtener todas las citas
$appointments = mysqli_query($con, "SELECT * FROM tblappointments");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title> Eliminar Cita</title>
</head>
<body>
    <h3>Eliminar Cita</h3>
    <p style="color:red;"> 
        <?php if (isset($msg)) { echo $msg; } ?> 
    </p>

    <form method="post" action="">
        <label for="appointment_id">Seleccionar Cita para Eliminar:</label>
        <select name="appointment_id" required="true">
            <?php while ($row = mysqli_fetch_assoc($appointments)) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['Name'] . " - " . $row['AptDate']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" name="delete" value="Eliminar Cita">
    </form>
</body>
</html>
