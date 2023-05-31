<?php
// Establecer conexión con la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'criptografia');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir los datos de inicio de sesión
$correo = $_POST['correo'];
$password = sha1($_POST['password']); // Aplicar hash SHA-1 a la contraseña (recomendado usar métodos más seguros)

// Consultar la base de datos para verificar los datos de inicio de sesión
$sql = "SELECT * FROM usr WHERE correo_electronico = '$correo'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $contrasenaBD = $fila['contrasena'];

    // Comparar la contraseña ingresada con la contraseña almacenada en la base de datos
    if ($password == $contrasenaBD) {
        // Las contraseñas coinciden, el inicio de sesión es exitoso
        // Redirigir al usuario a general.html
        header('Location: chisme.php?correo=' . urlencode($correo));
        exit();
    } else {
        // Las contraseñas no coinciden
        echo "Contraseña incorrecta";
    }
} else {
    // No se encontró un registro con el correo electrónico proporcionado
    echo "Correo electrónico no registrado";
}

// Cerrar la conexión con la base de datos
$conexion->close();
?>
