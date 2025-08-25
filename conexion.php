<?php
// Datos de conexión a la base de datos
$host = "localhost";     // Servidor de base de datos
$user = "root";          // Usuario de la base de datos
$pass = "";              // Contraseña del usuario (vacía en este caso)
$db = "tb_al";           // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    // Si hay error, termina el script y muestra el mensaje
    die("Error de conexión: " . $conn->connect_error);
}

// Si no hay error, la conexión fue exitosa y se puede continuar con las consultas
?>