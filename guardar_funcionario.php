<?php
include 'conexion.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellidos_nombres = htmlspecialchars(trim($_POST['apellidos_nombres']));
    $telefono_institucional = htmlspecialchars(trim($_POST['telefono_institucional']));
    $profesion = htmlspecialchars(trim($_POST['profesion']));
    $perfil = htmlspecialchars(trim($_POST['perfil']));
    $cargo = htmlspecialchars(trim($_POST['cargo']));
    $decreto = htmlspecialchars(trim($_POST['decreto']));
    $enlace_sigep = filter_var(trim($_POST['enlace_sigep']), FILTER_VALIDATE_URL);
    $correo = filter_var(trim($_POST['correo_electronico_institucional']), FILTER_VALIDATE_EMAIL);
    $direccion = htmlspecialchars(trim($_POST['direccion']));
    $horario = htmlspecialchars(trim($_POST['horario_trabajo']));
    $enlace_foto = filter_var(trim($_POST['enlace_foto']), FILTER_VALIDATE_URL);

    if (!$apellidos_nombres || !$correo || !$enlace_sigep || !$enlace_foto) {
        echo json_encode([
            "status" => "error",
            "message" => "Campos requeridos inválidos o vacíos"
        ]);
        exit;
    }

    $sql = "INSERT INTO funcionarios (apellidos_nombres, telefono_institucional, profesion, perfil, cargo, decreto, enlace_sigep, correo_electronico_institucional, direccion, horario_trabajo, enlace_foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $apellidos_nombres, $telefono_institucional, $profesion, $perfil, $cargo, $decreto, $enlace_sigep, $correo, $direccion, $horario, $enlace_foto);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Datos guardados correctamente."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error al guardar los datos: " . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();
}
?>