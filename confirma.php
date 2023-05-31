<?php
// Establecer conexión con la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'criptografia');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibimos el correo del formulario
$correo = $_POST['correo'];

// Buscar el código de confirmación en la base de datos
$sql = "SELECT numeroConfirmacion FROM usr WHERE correo_electronico = '$correo'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // El correo existe en la base de datos, podemos comparar el código de confirmación
    $row = $resultado->fetch_assoc();
    $codigoConfirmacionBD = $row['numeroConfirmacion'];
    
    // Recibimos el código de confirmación desde el formulario
    $codigoConfirmacionFormulario = $_POST['codigo'];

    if ($codigoConfirmacionBD == $codigoConfirmacionFormulario) {
        // El código de confirmación es correcto
        //redirige a pantalla de agradecimiento y carga la principal
        header('Location: agradecimiento.html');
        exit();
    } else {
        // El código de confirmación es incorrecto
        echo "Código de confirmación inválido. Por favor, verifica tu correo y el código.";
    }
} else {
    // El correo no existe en la base de datos
    echo "El correo electrónico no está registrado.";
}

// Cerrar la conexión con la base de datos
$conexion->close();
?>
