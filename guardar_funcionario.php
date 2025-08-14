<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Verifica que la solicitud sea de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitiza y valida los datos recibidos del formulario
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

    // Verifica que los campos requeridos no estén vacíos
    if (!$apellidos_nombres || !$correo || !$enlace_sigep || !$enlace_foto) {
        echo "Error: Algunos campos requeridos están vacíos o son inválidos.";
        exit;
    }

    // Prepara la consulta SQL con placeholders
    $sql = "INSERT INTO funcionarios 
            (apellidos_nombres, telefono_institucional, profesion, perfil, cargo, decreto, enlace_sigep, correo_electronico_institucional, direccion, horario_trabajo, enlace_foto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara la consulta evitando inyección SQL
    $stmt = $conn->prepare($sql);

    // Asocia los parámetros a la consulta
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

    // Ejecuta la consulta y muestra un mensaje según el resultado
    if ($stmt->execute()) {
        echo "✅ Datos guardados correctamente.";
    } else {
        echo "❌ Error al guardar los datos: " . $stmt->error;
    }

    // Cierra la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>