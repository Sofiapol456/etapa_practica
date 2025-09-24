<?php
require_once 'conexion.php';

$sql = "SELECT id_documento, apellidos_nombres, cargo, perfil, fecha_ingreso FROM funcionarios ORDER BY fecha_ingreso DESC";
$result = $conn->query($sql);

$funcionarios = [];

while ($row = $result->fetch_assoc()) {
    $funcionarios[] = $row;
}

header('Content-Type: application/json');
echo json_encode($funcionarios);

$conn->close();
?>