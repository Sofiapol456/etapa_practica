<?php
include 'conexion.php';

// Establecer cabeceras para JSON y permitir solicitudes desde cualquier origen
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Consulta SQL para obtener todos los campos, incluido el ID
$sql = "SELECT id, apellidos_nombres, telefono_institucional, profesion, perfil, cargo, decreto, enlace_sigep, correo_electronico_institucional, direccion, horario_trabajo, enlace_foto FROM funcionarios ORDER BY id ASC";

$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al ejecutar la consulta SQL',
        'error' => $conn->error
    ]);
    $conn->close();
    exit;
}

// Crear arreglo para almacenar los funcionarios
$funcionarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $funcionarios[] = $row;
    }
}

// Enviar respuesta en formato JSON
echo json_encode([
    'status' => 'success',
    'data' => $funcionarios
]);

// Cierra la conexión
$conn->close();
?>