<?php
// Establecer conexión con la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'criptografia');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir los datos de registro
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']); // Aplicar hash SHA-1 a la contraseña (recomendado usar métodos más seguros)

// Generar un número aleatorio de confirmación
$numeroConfirmacion = mt_rand(100000, 999999);

// Guardar el número de confirmación en la base de datos
$sql = "UPDATE usr SET numeroconfirmacion = $numeroConfirmacion WHERE correo_electronico = '$correo'";
if ($conexion->query($sql) === FALSE) {
    echo "Error al guardar el número de confirmación: " . $conexion->error;
    $conexion->close();
    exit();
}

// Enviar el correo electrónico de confirmación
$asunto = "Confirmación de cuenta";
$mensaje = "Estimado $nombre,\n\n";
$mensaje .= "Gracias por registrarte. Para confirmar tu cuenta, utiliza el siguiente número de confirmación:\n\n";
$mensaje .= "Número de confirmación: $numeroConfirmacion\n\n";
$mensaje .= "Por favor, ingresa este número en la página de confirmación de tu cuenta.\n\n";
$mensaje .= "Si no has solicitado esta confirmación, puedes ignorar este correo electrónico.\n\n";
$mensaje .= "Atentamente,\n";
$mensaje .= "Equipo de confirmación";

// Puedes personalizar el remitente y las cabeceras del correo electrónico según tus necesidades
$remitente = "noreply@example.com";
$cabeceras = "From: $remitente";

if (mail($correo, $asunto, $mensaje, $cabeceras)) {
    echo "Se ha enviado un correo de confirmación a tu dirección de correo electrónico.";
} else {
    echo "Error al enviar el correo de confirmación. Por favor, inténtalo más tarde.";
}

// Cerrar la conexión con la base de datos
$conexion->close();
?>
