<?php
// Verificar si se reciben datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron los datos esperados
    if (isset($_POST["customerFirstName"]) && isset($_POST["customerLastName"]) && isset($_POST["customerEmail"]) && isset($_POST["customerPhone"])) {
        // Recuperar los datos del formulario
        $customerFirstName = $_POST["customerFirstName"];
        $customerLastName = $_POST["customerLastName"];
        $customerEmail = $_POST["customerEmail"];
        $customerPhone = $_POST["customerPhone"];

        // Establecer conexión con la base de datos
        $servername = "localhost"; // Cambiar si es necesario
        $username = "root"; // nombre de usuario de base de datos
        $password = ""; // contraseña de base de datos
        $dbname = "tiendajuguetes"; // Nombre de base de datos

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de clientes
        $sql = "INSERT INTO clientes (Nombre, Apellido, Correo_Electronico, Telefono) VALUES ('$customerFirstName', '$customerLastName', '$customerEmail', '$customerPhone')";
        if ($conn->query($sql) === TRUE) {
            echo "Cliente registrado exitosamente: $customerFirstName $customerLastName";
        } else {
            echo "Error al registrar el cliente: " . $conn->error;
        }

        // Cerrar conexión
        $conn->close();
    } else {
        // Si falta algún dato, devolver un mensaje de error
        echo "Error: Faltan datos del cliente";
    }
} else {
    // Si no es una solicitud POST, devolver un mensaje de error
    echo "Error: Método de solicitud no válido";
}
?>
