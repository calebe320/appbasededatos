<?php
// Verificar si se reciben datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron los datos esperados
    if (isset($_POST["customerName"]) && isset($_POST["products"])) {
        // Recuperar los datos del formulario
        $customerName = $_POST["customerName"];
        $products = $_POST["products"];

        // Establecer conexión con la base de datos
        $servername = "localhost"; // Cambiar si es necesario
        $username = "root"; // nombre de usuario de base de datos
        $password = ""; // contraseña d base de datos
        $dbname = "tiendajuguetes"; // Nombre de base de datos

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de ventas
        $sql = "INSERT INTO ventas (ID_Cliente) VALUES ('$customerName')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            // Insertar los productos vendidos en la tabla de ventas_productos
            foreach ($products as $product) {
                $product_id = $product['id'];
                $quantity = $product['quantity'];
                $sql = "INSERT INTO ventas_productos (ID_Venta, ID_Producto, Cantidad) VALUES ('$last_id', '$product_id', '$quantity')";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error al insertar productos: " . $conn->error;
                }
            }
            echo "Transacción registrada exitosamente para: $customerName";
        } else {
            echo "Error al registrar la transacción: " . $conn->error;
        }

        // Cerrar conexión
        $conn->close();
    } else {
        // Si falta algún dato, devolver un mensaje de error
        echo "Error: Faltan datos de la transacción";
    }
} else {
    // Si no es una solicitud POST, devolver un mensaje de error
    echo "Error: Método de solicitud no válido";
}
?>
