<?php
// Incluye el archivo de conexión a la base de datos 
include 'conexion.php';

// Verifica si la solicitud se ha realizado mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitiza y elimina espacios extra del campo Apellidos y Nombres
    $apellidos_nombres = htmlspecialchars(trim($_POST['apellidos_nombres']));

    // Sanitiza y elimina espacios del campo Teléfono Institucional
    $telefono_institucional = htmlspecialchars(trim($_POST['telefono_institucional']));

    // Sanitiza y elimina espacios del campo Profesión
    $profesion = htmlspecialchars(trim($_POST['profesion']));

    // Sanitiza y elimina espacios del campo Perfil 
    $perfil = htmlspecialchars(trim($_POST['perfil']));

    // Sanitiza y elimina espacios del campo Cargo
    $cargo = htmlspecialchars(trim($_POST['cargo']));

    // Sanitiza y elimina espacios del campo Decreto
    $decreto = htmlspecialchars(trim($_POST['decreto']));

    // Sanitiza y valida el campo Enlace SIGEP como URL válida
    $enlace_sigep = filter_var(trim($_POST['enlace_sigep']), FILTER_VALIDATE_URL);

    // Sanitiza y valida el campo Correo Institucional como email válido
    $correo = filter_var(trim($_POST['correo_electronico_institucional']), FILTER_VALIDATE_EMAIL);

    // Sanitiza y elimina espacios del campo Dirección
    $direccion = htmlspecialchars(trim($_POST['direccion']));

    // Sanitiza y elimina espacios del campo Horario
    $horario = htmlspecialchars(trim($_POST['horario_trabajo']));

    // Sanitiza y valida el campo Enlace Foto como URL válida
    $enlace_foto = filter_var(trim($_POST['enlace_foto']), FILTER_VALIDATE_URL);

    // Valida que los campos obligatorios no estén vacíos o inválidos
    if (!$apellidos_nombres || !$correo || !$enlace_sigep || !$enlace_foto) {
        echo "Error: Algunos campos requeridos están vacíos o son inválidos.";
        exit; // Detiene la ejecución si hay errores
    }

    // Prepara una consulta SQL para insertar los datos en la tabla "secretarios"
    $sql = "INSERT INTO secretarios 
            (apellidos_nombres, telefono_institucional, profesion, perfil, cargo, decreto, enlace_sigep, correo_electronico_institucional, direccion, horario_trabajo, enlace_foto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara la declaración SQL para evitar inyecciones 
    $stmt = $conn->prepare($sql);

    // Enlaza los parámetros con los valores de PHP 
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

    // Ejecuta la consulta SQL y verifica si se insertó correctamente
    if ($stmt->execute()) {
        echo "✅ Datos de secretario guardados correctamente.";
    } else {
        // Muestra el error si la ejecución falla
        echo "❌ Error al guardar datos: " . $stmt->error;
    }

    // Cierra la declaración preparada
    $stmt->close();

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
