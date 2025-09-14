<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Validación del parámetro ID enviado por GET
// Se verifica que exista el parámetro 'id' y que sea un número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID inválido."; 
    exit; 
}

// Convertir el parámetro ID a entero para mayor seguridad
$id = intval($_GET['id']);

// Preparar la consulta SQL para obtener los datos del secretario con el ID proporcionado
$sql = "SELECT * FROM secretarios WHERE id = ?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id); 
$stmt->execute(); 
$result = $stmt->get_result(); 

// Verificar si se encontró algún registro con ese ID
if ($result->num_rows === 0) {
    echo "Secretario no encontrado.";
    exit;
}

// Obtener los datos del secretario en un arreglo asociativo
$secretario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Secretario</title>
    <!-- Enlace a la hoja de estilos de Bootstrap para dar estilo al contenido -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-4">
    <!-- Encabezado con título y botón para volver -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalle del Secretario</h2>
        <a href="index.php" class="btn btn-secondary">← Volver</a>
    </div>

    <!-- Tarjeta Bootstrap que contiene los detalles del secretario -->
    <div class="card">
        <div class="card-body">
            <!-- Mostrar el nombre completo del secretario, escapando caracteres especiales -->
            <h4 class="card-title"><?= htmlspecialchars($secretario['apellidos_nombres']) ?></h4>

            <!-- Mostrar teléfono institucional o mensaje si no está disponible -->
            <p><strong>Teléfono Institucional:</strong> 
                <?= htmlspecialchars($secretario['telefono_institucional']) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar profesión o mensaje si no está disponible -->
            <p><strong>Profesión:</strong> 
                <?= htmlspecialchars($secretario['profesion']) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar perfil con saltos de línea conservados, o mensaje si no disponible -->
            <p><strong>Perfil:</strong> 
                <?= nl2br(htmlspecialchars($secretario['perfil'])) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar cargo o mensaje si no está disponible -->
            <p><strong>Cargo:</strong> 
                <?= htmlspecialchars($secretario['cargo']) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar decreto o mensaje si no está disponible -->
            <p><strong>Decreto:</strong> 
                <?= htmlspecialchars($secretario['decreto']) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar enlace SIGEP si existe, sino mostrar 'No disponible' -->
            <p><strong>Enlace SIGEP:</strong>
                <?php if (!empty($secretario['enlace_sigep'])): ?>
                    <a href="<?= htmlspecialchars($secretario['enlace_sigep']) ?>" target="_blank" rel="noopener noreferrer">Ver SIGEP</a>
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </p>

            <!-- Mostrar correo institucional o mensaje si no está disponible -->
            <p><strong>Correo Institucional:</strong> 
                <?= htmlspecialchars($secretario['correo_electronico_institucional']) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar dirección o mensaje si no está disponible -->
            <p><strong>Dirección:</strong> 
                <?= htmlspecialchars($secretario['direccion']) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar horario con saltos de línea, o mensaje si no disponible -->
            <p><strong>Horario:</strong> 
                <?= nl2br(htmlspecialchars($secretario['horario_trabajo'])) ?: 'No disponible' ?>
            </p>

            <!-- Mostrar foto del secretario si hay enlace, sino mostrar mensaje -->
            <p><strong>Foto:</strong><br>
                <?php if (!empty($secretario['enlace_foto'])): ?>
                    <a href="<?= htmlspecialchars($secretario['enlace_foto']) ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?= htmlspecialchars($secretario['enlace_foto']) ?>" alt="Foto de <?= htmlspecialchars($secretario['apellidos_nombres']) ?>" style="max-width: 200px;">
                    </a>
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </p>
        </div>
    </div>
</body>
</html>