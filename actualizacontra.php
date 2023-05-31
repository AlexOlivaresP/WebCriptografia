<?php
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Establecer conexión con la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'criptografia');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir los datos del formulario
$correo = $_POST['correo'];
$password = sha1($_POST['password']);

// Insertar los datos en la base de datos
$sql = "UPDATE usr SET contrasena = '$password' WHERE correo_electronico = '$correo'";

if ($conexion->query($sql) === TRUE) {
    header('Location: agradecimiento.html');
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}
?>
