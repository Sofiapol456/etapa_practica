<?php
require_once 'conexion.php';

$id = $_GET['id_documento'] ?? '';

$stmt = $conn->prepare("DELETE FROM funcionarios WHERE id_documento = ?");
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    echo "Funcionario eliminado correctamente.";
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>