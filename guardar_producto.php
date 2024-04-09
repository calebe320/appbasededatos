<?php
// Verificar si se reciben datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron los datos esperados
    if (isset($_POST["productName"]) && isset($_POST["productDescription"]) && isset($_POST["productPrice"]) && isset($_POST["productQuantity"]) && isset($_POST["productSupplier"])) {
        // Recuperar los datos del formulario
        $productName = $_POST["productName"];
        $productDescription = $_POST["productDescription"];
        $productPrice = $_POST["productPrice"];
        $productQuantity = $_POST["productQuantity"];
        $productSupplier = $_POST["productSupplier"];

        // Establecer conexión con la base de datos
        $servername = "localhost"; // Cambiar si es necesario
        $username = "root"; //  nombre de usuario de base de datos
        $password = ""; // contraseña d base de datos
        $dbname = "tiendajuguetes"; // Nombre de base de datos

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla productos
        $sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Cantidad_Stock, ID_Proveedor)
                VALUES ('$productName', '$productDescription', $productPrice, $productQuantity, '$productSupplier')";

        if ($conn->query($sql) === TRUE) {
            echo "Producto registrado exitosamente: $productName";
        } else {
            echo "Error al registrar el producto: " . $conn->error;
        }

        // Cerrar conexión
        $conn->close();
    } else {
        // Si falta algún dato, devolver un mensaje de error
        echo "Error: Faltan datos del producto";
    }
} else {
    // Si no es una solicitud POST, devolver un mensaje de error
    echo "Error: Método de solicitud no válido";
}
?>
