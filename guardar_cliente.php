<?php
// Conexión a la base de datos
$servername = "localhost";
$dbname = "tiendajuguetes";
$username = "";
$password = "";

// Recibir datos del formulario
$nombre = $_POST['customerFirstName'];
$apellido = $_POST['customerLastName'];
$email = $_POST['customerEmail'];
$telefono = $_POST['customerPhone'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
