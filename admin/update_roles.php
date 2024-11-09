<?php
// Conexión a la base de datos
$servername = "localhost";  // Cambia si tu servidor no es localhost
$username = "root";          // Cambia si tienes otro usuario
$password = "";              // Cambia si tienes una contraseña
$dbname = "bpmsdb";         // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SELECT para obtener los registros de tbladmin
$select_sql = "SELECT * FROM `tbladmin` WHERE 1";
$result = $conn->query($select_sql);

// Mostrar los registros
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["ID"]. " - Nombre: " . $row["AdminName"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Consulta ALTER TABLE para agregar la columna Role
$alter_sql = "ALTER TABLE `tbladmin` ADD `Role` VARCHAR(50) NOT NULL DEFAULT 'user'";
if ($conn->query($alter_sql) === TRUE) {
    echo "Columna 'Role' agregada correctamente.";
} else {
    echo "Error al agregar columna: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
