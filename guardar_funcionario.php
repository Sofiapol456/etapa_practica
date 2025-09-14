<?php
include 'conexion.php'; // Asegúrate de que $conn esté definido aquí como instancia de mysqli

header('Content-Type: application/json');

// Verifica si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitiza y valida los datos recibidos
    $apellidos_nombres = htmlspecialchars(trim($_POST['apellidos_nombres'] ?? ''));
    $telefono_institucional = htmlspecialchars(trim($_POST['telefono_institucional'] ?? ''));
    $profesion = htmlspecialchars(trim($_POST['profesion'] ?? ''));
    $perfil = htmlspecialchars(trim($_POST['perfil'] ?? ''));
    $cargo = htmlspecialchars(trim($_POST['cargo'] ?? ''));
    $decreto = htmlspecialchars(trim($_POST['decreto'] ?? ''));
    $enlace_sigep = filter_var(trim($_POST['enlace_sigep'] ?? ''), FILTER_VALIDATE_URL);
    $correo = filter_var(trim($_POST['correo_electronico_institucional'] ?? ''), FILTER_VALIDATE_EMAIL);
    $direccion = htmlspecialchars(trim($_POST['direccion'] ?? ''));
    $horario = htmlspecialchars(trim($_POST['horario_trabajo'] ?? ''));
    $enlace_foto = filter_var(trim($_POST['enlace_foto'] ?? ''), FILTER_VALIDATE_URL);

    // Validación de campos requeridos
    if (
        empty($apellidos_nombres) ||
        empty($correo) ||
        !$enlace_sigep ||
        !$enlace_foto
    ) {
        echo json_encode([
            "status" => "error",
            "message" => "Campos requeridos inválidos o vacíos."
        ]);
        exit;
    }

    // Consulta preparada para insertar los datos
    $sql = "INSERT INTO funcionarios (
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
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode([
            "status" => "error",
            "message" => "Error al preparar la consulta: " . $conn->error
        ]);
        exit;
    }

    // Asocia parámetros a la consulta
    $stmt->bind_param(
        "sssssssssss",
        $apellidos_nombres,
        $telefono_institucional,
        $profesion,
        $perfil,
        $cargo,
        $decreto,
        $enlace_sigep,
        $correo,
        $direccion,
        $horario,
        $enlace_foto
    );

    // Ejecuta la consulta
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

    // Cierra recursos
    $stmt->close();
    $conn->close();
} else {
    // Si el método no es POST
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido. Solo se permite POST."
    ]);
}
?>