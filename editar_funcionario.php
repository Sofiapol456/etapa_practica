<?php
require_once 'conexion.php';

$id = $_GET['id_documento'] ?? '';

if (!$id) {
    echo "Documento no especificado.";
    exit;
}

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="m-0">Editar Funcionario</h3>
    <a href="personal.php" class="btn btn-secondary">Volver</a>
  </div>

  <form id="formEditarFuncionario" action="actualizar_funcionario.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_documento" value="<?= htmlspecialchars($funcionario['id_documento']) ?>">

    <div class="mb-3">
      <label for="apellidos_nombres">Apellidos y Nombres</label>
      <input
        type="text"
        class="form-control"
        id="apellidos_nombres"
        name="apellidos_nombres"
        value="<?= htmlspecialchars($funcionario['apellidos_nombres']) ?>"
        required
        minlength="6"
        oninput="this.value = this.value.toUpperCase();"
      >
    </div>

    <div class="mb-3">
      <label for="telefono_institucional">Teléfono Institucional</label>
      <input
        type="text"
        class="form-control"
        id="telefono_institucional"
        name="telefono_institucional"
        value="<?= htmlspecialchars($funcionario['telefono_institucional']) ?>"
        required
        maxlength="20"
        inputmode="numeric"
        pattern="\d+"
        title="Sólo números"
      >
    </div>

    <div class="mb-3">
      <label for="correo_electronico_institucional">Correo Institucional</label>
      <input
        type="email"
        class="form-control"
        id="correo_electronico_institucional"
        name="correo_electronico_institucional"
        value="<?= htmlspecialchars($funcionario['correo_electronico_institucional']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="profesion">Profesión</label>
      <input
        type="text"
        class="form-control"
        id="profesion"
        name="profesion"
        value="<?= htmlspecialchars($funcionario['profesion']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="perfil">Perfil</label>
      <textarea
        class="form-control"
        id="perfil"
        name="perfil"
        rows="3"
        required
      ><?= htmlspecialchars($funcionario['perfil']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="cargo">Cargo</label>
      <input
        type="text"
        class="form-control"
        id="cargo"
        name="cargo"
        value="<?= htmlspecialchars($funcionario['cargo']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="decreto">Decreto</label>
      <input
        type="text"
        class="form-control"
        id="decreto"
        name="decreto"
        value="<?= htmlspecialchars($funcionario['decreto']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="enlace_sigep">Enlace SIGEP</label>
      <input
        type="url"
        class="form-control"
        id="enlace_sigep"
        name="enlace_sigep"
        value="<?= htmlspecialchars($funcionario['enlace_sigep']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="direccion">Dirección</label>
      <input
        type="text"
        class="form-control"
        id="direccion"
        name="direccion"
        value="<?= htmlspecialchars($funcionario['direccion']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="horario_trabajo">Horario de Trabajo</label>
      <input
        type="text"
        class="form-control"
        id="horario_trabajo"
        name="horario_trabajo"
        value="<?= htmlspecialchars($funcionario['horario_trabajo']) ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label for="foto_funcionario">Foto (opcional)</label>
      <input
        type="file"
        class="form-control"
        id="foto_funcionario"
        name="foto_funcionario"
        accept=".jpg, .jpeg, .png"
      >
      <?php if (!empty($funcionario['foto_funcionario'])): ?>
        <div class="mt-2">
          <img src="uploads/<?= htmlspecialchars($funcionario['foto_funcionario']) ?>" width="120" class="img-thumbnail">
        </div>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="detalle_funcionario.php?id_documento=<?= urlencode($funcionario['id_documento']) ?>" class="btn btn-secondary">Cancelar</a>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/validacion_formulario.js"></script>
</body>
</html>