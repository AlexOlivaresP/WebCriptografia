<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "criptografia";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa";

// Cerrar la conexión
$conn->close();
?>
