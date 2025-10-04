<?php
require_once 'conexion.php';

$id = $_POST['id_documento'] ?? '';
$apellidos_nombres = strtoupper(trim($_POST['apellidos_nombres'] ?? ''));
$telefono = preg_replace('/\D/', '', $_POST['telefono_institucional'] ?? '');
$correo = trim($_POST['correo_electronico_institucional'] ?? '');
$profesion = trim($_POST['profesion'] ?? '');
$perfil = trim($_POST['perfil'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');
$decreto = trim($_POST['decreto'] ?? '');
$enlace_sigep = trim($_POST['enlace_sigep'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$horario = trim($_POST['horario_trabajo'] ?? '');

// Validaciones
if (!empty($telefono) && !preg_match('/^\d+$/', $telefono)) {
    die("El teléfono solo debe contener números.");
}
if (!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Correo institucional inválido.");
}
if (!empty($enlace_sigep) && !filter_var($enlace_sigep, FILTER_VALIDATE_URL)) {
    die("Enlace SIGEP inválido.");
}

// Manejo de imagen (opcional) — igual que antes
$foto_nombre = null;
if (isset($_FILES['foto_funcionario']) && $_FILES['foto_funcionario']['error'] === UPLOAD_ERR_OK) {
    $foto_tmp = $_FILES['foto_funcionario']['tmp_name'];
    $foto_nombre_original = basename($_FILES['foto_funcionario']['name']);
    $extension = strtolower(pathinfo($foto_nombre_original, PATHINFO_EXTENSION));
    $permitidos = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $permitidos)) {
        die("Formato de imagen no permitido. Solo JPG, JPEG o PNG.");
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $foto_tmp);
    finfo_close($finfo);
    $mime_permitidos = ['image/jpeg', 'image/png'];
    if (!in_array($mime, $mime_permitidos)) {
        die("El archivo no es una imagen válida.");
    }
    $foto_nombre = uniqid('foto_', true) . '.' . $extension;
    $ruta_destino = 'uploads/' . $foto_nombre;
    if (!move_uploaded_file($foto_tmp, $ruta_destino)) {
        die("Error al subir la foto.");
    }
}

// Preparar SQL
if ($foto_nombre) {
    $sql = "UPDATE funcionarios SET 
        apellidos_nombres = ?, telefono_institucional = ?, correo_electronico_institucional = ?, 
        profesion = ?, perfil = ?, cargo = ?, decreto = ?, enlace_sigep = ?, direccion = ?, horario_trabajo = ?, foto_funcionario = ?
        WHERE id_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $apellidos_nombres, $telefono, $correo, $profesion, $perfil, $cargo, $decreto, $enlace_sigep, $direccion, $horario, $foto_nombre, $id);
} else {
    $sql = "UPDATE funcionarios SET 
        apellidos_nombres = ?, telefono_institucional = ?, correo_electronico_institucional = ?, 
        profesion = ?, perfil = ?, cargo = ?, decreto = ?, enlace_sigep = ?, direccion = ?, horario_trabajo = ?
        WHERE id_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $apellidos_nombres, $telefono, $correo, $profesion, $perfil, $cargo, $decreto, $enlace_sigep, $direccion, $horario, $id);
}

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: detalle_funcionario.php?id_documento=" . urlencode($id));
        exit;
    } else {
        echo "<script>alert('No se realizaron cambios. Verifique que modificó algún campo.'); 
              window.location.href='editar_funcionario.php?id_documento=" . urlencode($id) . "';</script>";
        exit;
    }
} else {
    echo "Error al actualizar: " . $stmt->error;
}
?>