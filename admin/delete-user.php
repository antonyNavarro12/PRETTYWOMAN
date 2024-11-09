<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_GET['delid'])) {
    $delid = intval($_GET['delid']);
    $query = mysqli_query($con, "DELETE FROM tbladmin WHERE ID='$delid'");

    if ($query) {
        // Redirigir a la lista de usuarios después de eliminar
        header('Location: view_users.php');
        exit();
    } else {
        echo "<script>alert('Error al eliminar el usuario: " . mysqli_error($con) . "');</script>";
        echo "<script>window.history.back();</script>"; // Regresar a la página anterior
        exit();
    }
}
?>
