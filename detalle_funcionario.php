<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Verifica si el parámetro 'id' está presente en la URL y es un número
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si no es válido, muestra un mensaje de error y termina la ejecución
    echo "ID inválido.";
    exit;
}

// Convierte el parámetro 'id' a un entero para evitar inyección SQL
$id = intval($_GET['id']);

// Prepara la consulta SQL para obtener los datos del funcionario con el id especificado
$sql = "SELECT * FROM funcionarios WHERE id = ?";
$stmt = $conn->prepare($sql);

// Vincula el parámetro 'id' a la consulta preparada (tipo entero)
$stmt->bind_param("i", $id);

// Ejecuta la consulta
$stmt->execute();

// Obtiene el resultado de la consulta
$result = $stmt->get_result();

// Verifica si no se encontró ningún funcionario con ese ID
if ($result->num_rows === 0) {
    // Si no existe, muestra mensaje y termina la ejecución
    echo "Funcionario no encontrado.";
    exit;
}

// Obtiene los datos del funcionario como un arreglo asociativo
$funcionario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Funcionario</title>
    <!-- Incluye el CSS de Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-4">
    <!-- Encabezado con título y botón para volver -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalle del Funcionario</h2>
        <a href="index.php" class="btn btn-secondary">← Volver</a>
    </div>

    <!-- Tarjeta con la información del funcionario -->
    <div class="card">
        <div class="card-body">
            <!-- Nombre completo del funcionario -->
            <h4 class="card-title"><?= htmlspecialchars($funcionario['apellidos_nombres']) ?></h4>

            <!-- Teléfono institucional, muestra "No disponible" si está vacío -->
            <p><strong>Teléfono Institucional:</strong> <?= htmlspecialchars($funcionario['telefono_institucional']) ?: 'No disponible' ?></p>

            <!-- Profesión, con valor por defecto si no existe -->
            <p><strong>Profesión:</strong> <?= htmlspecialchars($funcionario['profesion']) ?: 'No disponible' ?></p>

            <!-- Perfil, mantiene saltos de línea y muestra valor por defecto -->
            <p><strong>Perfil:</strong> <?= nl2br(htmlspecialchars($funcionario['perfil'])) ?: 'No disponible' ?></p>

            <!-- Cargo -->
            <p><strong>Cargo:</strong> <?= htmlspecialchars($funcionario['cargo']) ?: 'No disponible' ?></p>

            <!-- Decreto -->
            <p><strong>Decreto:</strong> <?= htmlspecialchars($funcionario['decreto']) ?: 'No disponible' ?></p>

            <!-- Enlace SIGEP, muestra un enlace solo si está disponible -->
            <p><strong>Enlace SIGEP:</strong>
                <?php if (!empty($funcionario['enlace_sigep'])): ?>
                    <a href="<?= htmlspecialchars($funcionario['enlace_sigep']) ?>" target="_blank" rel="noopener noreferrer">Ver SIGEP</a>
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </p>

            <!-- Correo institucional -->
            <p><strong>Correo Institucional:</strong> <?= htmlspecialchars($funcionario['correo_electronico_institucional']) ?: 'No disponible' ?></p>

            <!-- Dirección -->
            <p><strong>Dirección:</strong> <?= htmlspecialchars($funcionario['direccion']) ?: 'No disponible' ?></p>

            <!-- Horario de trabajo, con saltos de línea -->
            <p><strong>Horario:</strong> <?= nl2br(htmlspecialchars($funcionario['horario_trabajo'])) ?: 'No disponible' ?></p>

            <!-- Foto, si hay enlace, muestra la imagen en miniatura con enlace -->
            <p><strong>Foto:</strong><br>
                <?php if (!empty($funcionario['enlace_foto'])): ?>
                    <a href="<?= htmlspecialchars($funcionario['enlace_foto']) ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?= htmlspecialchars($funcionario['enlace_foto']) ?>" alt="Foto de <?= htmlspecialchars($funcionario['apellidos_nombres']) ?>" style="max-width: 200px;">
                    </a>
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </p>
        </div>
    </div>
</body>
</html>