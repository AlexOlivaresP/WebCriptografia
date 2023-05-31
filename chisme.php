<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav class="navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <span class="navbar-text">
                    INICIO
                </span>
            </div>
        </nav>

    </header>
    <?php
    // Establecer conexión con la base de datos
    $conexion = new mysqli('localhost', 'root', 'root', 'criptografia');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Recibimos el correo del php anterior
    $correo = $_GET['correo'];

    //Buscar el correo en la base de datos
    $sql = "SELECT * FROM usr WHERE correo_electronico = '$correo'";
    $resultado = $conexion->query($sql);

    //extraer el nombre
    $row = $resultado->fetch_assoc();
    $nombre = $row['nombre'];


    ?>


    <h2 class="mx-auto p-2" style="width: 50%;">¡Hola <?php echo $nombre ?>!</h2>

    <div class="card mx-auto p-2" style="width: 50%;">
        <img src="Default_A_mysterious_photo_of_a_hacker_typing_in_a_complex_co_1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <p class="card-text">
                La máquina Enigma: Durante la Segunda Guerra Mundial, la máquina Enigma fue utilizada por los nazis para cifrar sus comunicaciones. A pesar de su aparente invulnerabilidad, los criptoanalistas aliados lograron descifrarla, un logro que se considera crucial para el resultado de la guerra.<br><br>

                La máquina Enigma fue un dispositivo de cifrado electromecánico utilizado por las fuerzas armadas alemanas durante la Segunda Guerra Mundial. Fue inventada a principios de la década de 1920 por el ingeniero alemán Arthur Scherbius. La máquina Enigma se convirtió en una de las herramientas de cifrado más sofisticadas y complejas de su tiempo.<br><br>

                El principio de funcionamiento de la máquina Enigma se basaba en una serie de rotores giratorios. Cada rotor contenía un conjunto de contactos eléctricos que conectaban las letras del alfabeto. Al presionar una tecla en el teclado, la corriente eléctrica pasaba a través de los rotores y encriptaba la letra en un carácter diferente. La configuración de los rotores y sus conexiones eléctricas se cambiaba diariamente según claves preestablecidas, lo que hacía que el cifrado fuera muy complejo.<br><br>

                Los nazis confiaban en la seguridad de la máquina Enigma, ya que creían que era invulnerable debido a las enormes posibilidades de configuración que ofrecía. Sin embargo, los criptoanalistas aliados se enfrentaron al desafío de descifrar las comunicaciones encriptadas por Enigma.<br><br>

                Uno de los avances más significativos en el descifrado de Enigma se produjo en la década de 1930, cuando el matemático polaco Marian Rejewski logró deducir la estructura interna de la máquina y desarrolló un método para romper su cifrado. Sin embargo, a medida que los alemanes mejoraban la seguridad de Enigma, Rejewski y sus colegas tuvieron que adaptar constantemente sus métodos.<br><br>

                La verdadera victoria en el descifrado de Enigma se produjo cuando Alan Turing, un matemático británico y pionero de la informática, lideró un equipo de criptoanalistas en Bletchley Park, una mansión en el Reino Unido. Allí, desarrollaron la máquina electromecánica llamada "Bomba" para acelerar el proceso de descifrado de Enigma.<br><br>

                La capacidad de Turing y su equipo para descifrar las comunicaciones cifradas por Enigma fue un logro crucial para los Aliados. Les permitió obtener información valiosa sobre los planes y movimientos de las fuerzas alemanas, lo que les dio una ventaja estratégica significativa durante la guerra.<br><br>

            </p>
        </div>
    </div>


</body>

</html>