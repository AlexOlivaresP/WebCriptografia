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

// Recuperar el correo
$sql = "SELECT * FROM usr WHERE correo_electronico = '$correo'";
$resultado = $conexion->query($sql);

// Si el correo no existe en la base de datos, mostrar error
if ($resultado->num_rows === 0) {
    echo "Error: " . $sql . "<br>" . $conexion->error;
    header('Location: error.html');
    exit();
}

// Recuperar el nombre
$row = $resultado->fetch_assoc();
$nombre = $row['nombre'];

$numeroConfirmacion = mt_rand(100000, 999999);

// Insertar el número de confirmación en la base de datos
$sql = "UPDATE usr SET numeroConfirmacion = '$numeroConfirmacion' WHERE correo_electronico = '$correo'";
if (!$conexion->query($sql)) {
    echo "Error al actualizar los datos: " . $conexion->error;
    exit();
}

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
    $mail->setFrom('derecholaboralintegral.contacto@gmail.com', 'noreply-recupera_contrasena'); // Cambia 'tu_correo' por tu dirección de correo de Gmail
    $mail->addAddress($correo, $nombre);

    // Contenido del correo electrónico
    $mail->Subject = 'recupera_contrasena';
    $mail->Body = '
    Estimad@ ' . $nombre . ',

    Confirma que estás intentando recuperar tu cuenta con el correo electrónico: ' . $correo . '
    Para ello, ingresa en tu navegador el siguiente código de confirmación: ' . $numeroConfirmacion . '

    Saludos cordiales,
    EQUIPO 1 CRIPTOGRAFIA :)
    ';

    // Envío del correo electrónico
    $mail->send();
    // echo "Se ha enviado un correo de confirmación a tu dirección de correo electrónico.";
    // Redireccionar al usuario a la página de confirmación
    header('Location: confirmacion2.html');
    exit();
} catch (Exception $e) {
    echo "Error al enviar el correo de confirmación: " . $mail->ErrorInfo;
}
?>
