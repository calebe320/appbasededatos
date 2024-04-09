<?php
// Conexión a la base de datos
$servername = "localhost";
$dbname = "tiendajuguetes";
$username = "";
$password = "";

// Recibir datos del formulario
$clienteNombre = $_POST['customerName'];
$productos = $_POST['productos']; // Esto sería un array de productos con su cantidad, puedes manejarlo como prefieras

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar datos en la tabla de ventas
$sql = "INSERT INTO ventas (ID_Cliente) VALUES ('$clienteNombre')";

if ($conn->query($sql) === TRUE) {
    $ventaID = $conn->insert_id; // Obtener el ID de la venta recién insertada

    // Insertar productos vendidos en la tabla de ventas_productos
    foreach ($productos as $producto) {
        $productoID = $producto['ID_Producto'];
        $cantidad = $producto['Cantidad'];
        $sql = "INSERT INTO ventas_productos (ID_Venta, ID_Producto, Cantidad)
                VALUES ('$ventaID', '$productoID', '$cantidad')";
        $conn->query($sql);
    }

    echo "Transacción registrada con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
