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
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']); // Aplicar hash SHA-1 a la contraseña (recomendado usar métodos más seguros)
$numeroConfirmacion = mt_rand(100000, 999999);

// Insertar los datos en la base de datos
$sql = "INSERT INTO usr (nombre, contrasena,correo_electronico, numeroConfirmacion) VALUES ('$nombre', '$password','$correo', '$numeroConfirmacion')";
if ($conexion->query($sql) === TRUE) {
    echo "Se ha creado la cuenta exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

//recuperar el correo
$sql = "SELECT * FROM usr WHERE correo_electronico = '$correo'";
$resultado = $conexion->query($sql);

// //recuperar el nombre
// $sql = "SELECT * FROM usr WHERE nombre = '$nombre'";
// $resultado = $conexion->query($sql);

// Cerrar la conexión con la base de datos
$conexion->close();

try {
    // Configuración del servidor SMTP de Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'derecholaboralintegral.contacto@gmail.com'; // Cambia 'tu_correo' por tu dirección de correo de Gmail
    $mail->Password = 'inukplxiouzcxdgo'; // Cambia 'tu_contraseña' por tu contraseña de Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configuración del remitente y destinatario
    $mail->setFrom('derecholaboralintegral.contacto@gmail.com', 'noreply-confirmacion'); // Cambia 'tu_correo' por tu dirección de correo de Gmail
    $mail->addAddress($correo, $nombre);

    // Contenido del correo electrónico
    $mail->Subject = 'Confirma tu cuenta :)';
    $mail->Body = '
    Estimad@ ' . $nombre . ',

    Confirma tu cuenta con el correo electrónico: ' . $correo . '
    Para ello, ingresa en tu navegador el siguiente codigo de confirmacion: ' . $numeroConfirmacion . '

    Saludos cordiales,
    EQUIPO 1 CRIPTOGRAFIA :)
    ';

    // Envío del correo electrónico
    $mail->send();
    // echo "Se ha enviado un correo de confirmación a tu dirección de correo electrónico.";
    //enviar el correo por post
    header('Location: confirmacion.html');
    exit();
} catch (Exception $e) {
    echo "Error al enviar el correo de confirmación: " . $mail->ErrorInfo;
}


?>
