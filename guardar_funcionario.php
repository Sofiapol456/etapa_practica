<?php
require_once 'conexion.php'; // Incluimos la conexión

// Sanitizar entrada
function limpiar($dato) {
    return htmlspecialchars(trim($dato));
}

// Recoger datos del formulario
$id_documento = limpiar($_POST['id_documento']);
$apellidos_nombres = strtoupper(limpiar($_POST['apellidos_nombres']));
$telefono = limpiar($_POST['telefono_institucional']);
$profesion = limpiar($_POST['profesion']);
$perfil = limpiar($_POST['perfil']);
$cargo = limpiar($_POST['cargo']);
$decreto = limpiar($_POST['decreto']);
$enlace_sigep = limpiar($_POST['enlace_sigep']);
$correo = strtolower(limpiar($_POST['correo_electronico_institucional']));
$direccion = limpiar($_POST['direccion']);
$horario = limpiar($_POST['horario_trabajo']);

// Validar correo único
$verificar = $conn->prepare("SELECT 1 FROM funcionarios WHERE correo_electronico_institucional = ?");
$verificar->bind_param("s", $correo);
$verificar->execute();
$verificar->store_result();

if ($verificar->num_rows > 0) {
    echo "<script>alert('El correo institucional ya está registrado.'); window.history.back();</script>";
    exit;
}

// Procesar foto (si existe)
$foto_nombre = "";
if (isset($_FILES['foto_funcionario']) && $_FILES['foto_funcionario']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['foto_funcionario']['tmp_name'];
    $foto_nombre = time() . "_" . basename($_FILES['foto_funcionario']['name']);
    $ruta_destino = "uploads/" . $foto_nombre;

    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }

    move_uploaded_file($tmp_name, $ruta_destino);
}

// Insertar datos
$stmt = $conn->prepare("INSERT INTO funcionarios (
    id_documento, apellidos_nombres, telefono_institucional, profesion, perfil, cargo, decreto,
    enlace_sigep, correo_electronico_institucional, direccion, horario_trabajo, foto_funcionario
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssss",
    $id_documento, $apellidos_nombres, $telefono, $profesion, $perfil, $cargo, $decreto,
    $enlace_sigep, $correo, $direccion, $horario, $foto_nombre
);

if ($stmt->execute()) {
    echo "<script>alert('Funcionario " . $apellidos_nombres . " guardado correctamente.'); window.location.href='personal.php';</script>";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>