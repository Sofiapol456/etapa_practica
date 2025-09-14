<?php
// Incluye el archivo de conexión a la base de datos 
include 'conexion.php';

// Cabeceras HTTP para indicar tipo de contenido y permitir CORS 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

// Consulta SQL para obtener los secretarios
$sql = "SELECT 
            id,
            apellidos_nombres,
            telefono_institucional,
            profesion,
            perfil,
            cargo,
            decreto,
            enlace_sigep,
            correo_electronico_institucional,
            direccion,
            horario_trabajo,
            enlace_foto
        FROM secretarios 
        ORDER BY id ASC";

// Ejecuta la consulta
$result = $conn->query($sql);

// Verifica si la consulta se ejecutó correctamente
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

// Prepara el array de resultados
$secretarios = [];

if ($result->num_rows > 0) {
    // Recorre los resultados y agrega cada fila al array
    while ($row = $result->fetch_assoc()) {
        $secretarios[] = $row;
    }
}

// Devuelve la respuesta en formato JSON
echo json_encode([
    'status' => 'success',
    'data' => $secretarios
]);

// Cierra la conexión
$conn->close();
?>