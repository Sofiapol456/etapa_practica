<?php
require_once 'conexion.php';

$id = $_GET['id_documento'] ?? '';

$stmt = $conn->prepare("SELECT * FROM funcionarios WHERE id_documento = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$funcionario = $result->fetch_assoc();

if (!$funcionario) {
    echo "Funcionario no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Funcionario</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="m-0">Editar Funcionario</h3>
    <a href="personal.php" class="btn btn-secondary">Volver</a>
  </div>

  <form action="actualizar_funcionario.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_documento" value="<?= htmlspecialchars($funcionario['id_documento']) ?>">

    <div class="mb-3">
      <label>Apellidos y Nombres</label>
      <input type="text" class="form-control" name="apellidos_nombres" value="<?= htmlspecialchars($funcionario['apellidos_nombres']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Teléfono Institucional</label>
      <input type="text" class="form-control" name="telefono_institucional" value="<?= htmlspecialchars($funcionario['telefono_institucional']) ?>">
    </div>

    <div class="mb-3">
      <label>Correo Institucional</label>
      <input type="email" class="form-control" name="correo_electronico_institucional" value="<?= htmlspecialchars($funcionario['correo_electronico_institucional']) ?>">
    </div>

    <div class="mb-3">
      <label>Profesión</label>
      <input type="text" class="form-control" name="profesion" value="<?= htmlspecialchars($funcionario['profesion']) ?>">
    </div>

    <div class="mb-3">
      <label>Perfil</label>
      <textarea class="form-control" name="perfil"><?= htmlspecialchars($funcionario['perfil']) ?></textarea>
    </div>

    <div class="mb-3">
      <label>Cargo</label>
      <input type="text" class="form-control" name="cargo" value="<?= htmlspecialchars($funcionario['cargo']) ?>">
    </div>

    <div class="mb-3">
      <label>Decreto</label>
      <input type="text" class="form-control" name="decreto" value="<?= htmlspecialchars($funcionario['decreto']) ?>">
    </div>

    <div class="mb-3">
      <label>Enlace SIGEP</label>
      <input type="url" class="form-control" name="enlace_sigep" value="<?= htmlspecialchars($funcionario['enlace_sigep']) ?>">
    </div>

    <div class="mb-3">
      <label>Dirección</label>
      <input type="text" class="form-control" name="direccion" value="<?= htmlspecialchars($funcionario['direccion']) ?>">
    </div>

    <div class="mb-3">
      <label>Horario de Trabajo</label>
      <input type="text" class="form-control" name="horario_trabajo" value="<?= htmlspecialchars($funcionario['horario_trabajo']) ?>">
    </div>

    <div class="mb-3">
      <label>Foto (opcional)</label>
      <input type="file" name="foto_funcionario" class="form-control">
      <?php if (!empty($funcionario['foto_funcionario'])): ?>
        <div class="mt-2">
          <img src="uploads/<?= htmlspecialchars($funcionario['foto_funcionario']) ?>" width="120" class="img-thumbnail">
        </div>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="detalle_funcionario.php?id_documento=<?= urlencode($funcionario['id_documento']) ?>" class="btn btn-secondary">Cancelar</a>
  </form>
  <br>
</body>
</html>