<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Establece el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');

// Verifica que el parámetro 'id' esté presente en la URL y sea un número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si no es válido, retorna un mensaje de error en formato JSON y termina la ejecución
    echo json_encode([
        'status' => 'error',
        'message' => 'ID inválido.'
    ]);
    exit;
}

// Convierte el parámetro 'id' a entero para mayor seguridad
$id = intval($_GET['id']);

// Prepara una consulta SQL para obtener el nombre completo del secretario con el id dado
$stmt = $conn->prepare("SELECT apellidos_nombres FROM secretarios WHERE id = ?");

// Asigna el parámetro $id a la consulta (tipo entero)
$stmt->bind_param("i", $id);

// Ejecuta la consulta
$stmt->execute();

// Obtiene el resultado de la consulta
$resultado = $stmt->get_result();

// Verifica si no se encontró ningún secretario con ese id
if ($resultado->num_rows === 0) {
    // Retorna un mensaje de error indicando que no se encontró el secretario
    echo json_encode([
        'status' => 'error',
        'message' => 'Secretario no encontrado.'
    ]);
    exit;
}

// Obtiene el nombre completo del secretario encontrado
$nombre = $resultado->fetch_assoc()['apellidos_nombres'];

// Prepara una consulta SQL para eliminar el secretario con el id dado
$stmt = $conn->prepare("DELETE FROM secretarios WHERE id = ?");

// Asigna el parámetro $id a la consulta (tipo entero)
$stmt->bind_param("i", $id);

// Ejecuta la eliminación y verifica si fue exitosa
if ($stmt->execute()) {
    // Si fue exitosa, retorna un mensaje de éxito junto con el nombre del secretario eliminado
    echo json_encode([
        'status' => 'success',
        'message' => "Secretario eliminado.",
        'nombre' => $nombre
    ]);
} else {
    // Si hubo un error al eliminar, retorna un mensaje de error con la descripción del error
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al eliminar secretario: ' . $stmt->error
    ]);
}

// Cierra la sentencia preparada
$stmt->close();

// Cierra la conexión a la base de datos
$conn->close();
?>