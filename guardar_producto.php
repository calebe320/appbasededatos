<?php
// Conexión a la base de datos
$servername = "localhost";
$dbname = "tiendajuguetes";

$conn = new mysqli($servername, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formularios
$nombre = $_POST['productName'];
$descripcion = $_POST['productDescription'];
$precio = $_POST['productPrice'];
$cantidad = $_POST['productQuantity'];
$proveedor = $_POST['productSupplier'];

// Insertar datos en la tabla de productos
$sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Cantidad_Stock, Proveedor)
        VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', '$proveedor')";

if ($conn->query($sql) === TRUE) {
    echo "Producto registrado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
