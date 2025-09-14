<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Establece que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verifica si el parámetro 'id' está presente en la URL y si es un número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si no es válido, devuelve un error en formato JSON y termina la ejecución
    echo json_encode([
        'status' => 'error',
        'message' => 'ID inválido.'
    ]);
    exit; 
}

// Convierte el parámetro 'id' a un entero para seguridad
$id = intval($_GET['id']);

// Prepara una consulta para verificar si el funcionario con ese ID existe en la base de datos
$stmt = $conn->prepare("SELECT apellidos_nombres FROM funcionarios WHERE id = ?");
$stmt->bind_param("i", $id); 
$stmt->execute(); 
$resultado = $stmt->get_result(); 

// Si no existe ningún funcionario con ese ID, devuelve un error
if ($resultado->num_rows === 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Funcionario no encontrado.'
    ]);
    exit; 
}

// Obtiene el nombre completo del funcionario encontrado para mostrarlo luego
$nombre = $resultado->fetch_assoc()['apellidos_nombres'];

// Prepara la consulta para eliminar al funcionario con ese ID
$stmt = $conn->prepare("DELETE FROM funcionarios WHERE id = ?");
$stmt->bind_param("i", $id); 

// Ejecuta la eliminación y verifica si fue exitosa
if ($stmt->execute()) {
    // Si se eliminó correctamente, devuelve un mensaje de éxito y el nombre del funcionario eliminado
    echo json_encode([
        'status' => 'success',
        'message' => "Funcionario eliminado.",
        'nombre' => $nombre
    ]);
} else {
    // Si hubo un error al eliminar, devuelve un mensaje de error con detalles
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al eliminar funcionario: ' . $stmt->error
    ]);
}

// Cierra la sentencia preparada
$stmt->close();

// Cierra la conexión con la base de datos
$conn->close();
?>