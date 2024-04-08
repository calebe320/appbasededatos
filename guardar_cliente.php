<?php
// Conexión a la base de datos
$servername = "localhost";
$dbname = "tiendajuguetes";

$conn = new mysqli($servername, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['customerFirstName'];
$apellido = $_POST['customerLastName'];
$email = $_POST['customerEmail'];
$telefono = $_POST['customerPhone'];

// Insertar datos en la tabla de clientes
$sql = "INSERT INTO clientes (Nombre, Apellido, Correo_Electronico, Telefono)
        VALUES ('$nombre', '$apellido', '$email', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Cliente registrado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
