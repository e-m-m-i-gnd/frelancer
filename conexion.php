<?php
$host = "localhost"; // Nombre del servidor de la base de datos
$usuario = "root"; // Nombre de usuario de la base de datos
$contraseña = ""; // Contraseña de la base de datos
$base_datos = "frelance"; // Nombre de la base de datos

$conn = new mysqli($host, $usuario, $contraseña, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
?>
