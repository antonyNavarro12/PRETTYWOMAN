<?php
session_start();
include('includes/dbconnection.php');

if(isset($_GET['delid'])){
    $appointmentId = intval($_GET['delid']);
    $query = mysqli_query($con, "DELETE FROM tblappointment WHERE ID='$appointmentId'");

    if($query){
        // Redirigir a la lista de citas después de eliminar
        header('Location: editC.php'); // Asegúrate de que la redirección se haga sin salida previa
        exit();  // Detener la ejecución posterior del script para evitar más código ejecutándose
    } else {
        // Mostrar un mensaje de error si la eliminación falla
        echo "<script>alert('Hubo un error al eliminar la cita');</script>";
        echo "<script>window.history.back();</script>"; // Volver a la página anterior
        exit();
    }
}
?>
