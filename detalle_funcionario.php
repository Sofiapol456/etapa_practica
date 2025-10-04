<?php
require_once 'conexion.php';

$id = $_GET['id_documento'] ?? '';

$stmt = $conn->prepare("SELECT * FROM funcionarios WHERE id_documento = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Funcionario no encontrado.";
    exit;
}

$funcionario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle del Funcionario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="m-0">Datos del Funcionario</h3>
      <div>
        <a href="editar_funcionario.php?id_documento=<?= urlencode($id) ?>" class="btn btn-primary">Editar</a>
        <a href="personal.php" class="btn btn-secondary">Volver</a>
      </div>
    </div>

    <ul class="list-group">
      <li class="list-group-item">
        <strong>Documento:</strong><br>
        <?= htmlspecialchars($funcionario['id_documento']) ?>
      </li>
      <li class="list-group-item">
        <strong>Apellidos y Nombres:</strong><br>
        <?= htmlspecialchars($funcionario['apellidos_nombres']) ?>
      </li>
      <li class="list-group-item">
        <strong>Teléfono Institucional:</strong><br>
        <?= htmlspecialchars($funcionario['telefono_institucional']) ?>
      </li>
      <li class="list-group-item">
        <strong>Correo Institucional:</strong><br>
        <?= htmlspecialchars($funcionario['correo_electronico_institucional']) ?>
      </li>
      <li class="list-group-item">
        <strong>Profesión:</strong><br>
        <?= htmlspecialchars($funcionario['profesion']) ?>
      </li>
      <li class="list-group-item">
        <strong>Perfil:</strong><br>
        <?= nl2br(htmlspecialchars($funcionario['perfil'])) ?>
      </li>
      <li class="list-group-item">
        <strong>Cargo:</strong><br>
        <?= htmlspecialchars($funcionario['cargo']) ?>
      </li>
      <li class="list-group-item">
        <strong>Decreto:</strong><br>
        <?= htmlspecialchars($funcionario['decreto']) ?>
      </li>
      <li class="list-group-item">
        <strong>Enlace SIGEP:</strong><br>
        <a href="<?= htmlspecialchars($funcionario['enlace_sigep']) ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Ver SIGEP 🔗</a>
      </li>
      <li class="list-group-item">
        <strong>Dirección:</strong><br>
        <?= htmlspecialchars($funcionario['direccion']) ?>
      </li>
      <li class="list-group-item">
        <strong>Horario de Trabajo:</strong><br>
        <?= htmlspecialchars($funcionario['horario_trabajo']) ?>
      </li>
      <li class="list-group-item">
        <strong>Fecha de Ingreso:</strong><br>
        <?= htmlspecialchars($funcionario['fecha_ingreso']) ?>
      </li>
      <?php if (!empty($funcionario['foto_funcionario'])): ?>
        <li class="list-group-item">
          <strong>Foto:</strong><br>
          <img src="uploads/<?= htmlspecialchars($funcionario['foto_funcionario']) ?>" width="150" class="img-thumbnail mt-2" />
        </li>
      <?php endif; ?>
    </ul>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>