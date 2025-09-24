<?php
require_once 'conexion.php';

$id = $_POST['id_documento'] ?? '';
$apellidos_nombres = $_POST['apellidos_nombres'] ?? '';
$telefono = $_POST['telefono_institucional'] ?? '';
$correo = $_POST['correo_electronico_institucional'] ?? '';
$profesion = $_POST['profesion'] ?? '';
$perfil = $_POST['perfil'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$decreto = $_POST['decreto'] ?? '';
$enlace_sigep = $_POST['enlace_sigep'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$horario = $_POST['horario_trabajo'] ?? '';

$foto_nombre = null;

// Si se subió nueva foto
if (isset($_FILES['foto_funcionario']) && $_FILES['foto_funcionario']['error'] === UPLOAD_ERR_OK) {
    $foto_tmp = $_FILES['foto_funcionario']['tmp_name'];
    $foto_nombre = basename($_FILES['foto_funcionario']['name']);
    $ruta_destino = 'uploads/' . $foto_nombre;

    if (!move_uploaded_file($foto_tmp, $ruta_destino)) {
        echo "Error al subir la foto.";
        exit;
    }
}

// Preparar SQL con o sin foto
if ($foto_nombre) {
    $sql = "UPDATE funcionarios SET 
        apellidos_nombres = ?, 
        telefono_institucional = ?, 
        correo_electronico_institucional = ?, 
        profesion = ?, 
        perfil = ?, 
        cargo = ?, 
        decreto = ?, 
        enlace_sigep = ?, 
        direccion = ?, 
        horario_trabajo = ?, 
        foto_funcionario = ?
        WHERE id_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $apellidos_nombres, $telefono, $correo, $profesion, $perfil, $cargo, $decreto, $enlace_sigep, $direccion, $horario, $foto_nombre, $id);
} else {
    $sql = "UPDATE funcionarios SET 
        apellidos_nombres = ?, 
        telefono_institucional = ?, 
        correo_electronico_institucional = ?, 
        profesion = ?, 
        perfil = ?, 
        cargo = ?, 
        decreto = ?, 
        enlace_sigep = ?, 
        direccion = ?, 
        horario_trabajo = ?
        WHERE id_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $apellidos_nombres, $telefono, $correo, $profesion, $perfil, $cargo, $decreto, $enlace_sigep, $direccion, $horario, $id);
}

if ($stmt->execute()) {
    header("Location: detalle_funcionario.php?id_documento=" . urlencode($id));
    exit;
} else {
    echo "Error al actualizar: " . $stmt->error;
}
?>