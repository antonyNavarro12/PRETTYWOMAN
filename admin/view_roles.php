<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";          
$password = "";              
$dbname = "bpmsdb";         

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los roles de los administradores
$select_sql = "SELECT ID, AdminName, Role FROM `tbladmin`";
$result = $conn->query($select_sql);

// Mostrar los registros
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["ID"]. " - Nombre: " . $row["AdminName"]. " - Rol: " . $row["Role"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conn->close();
?>
