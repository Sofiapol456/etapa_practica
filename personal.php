<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Personal - Funcionarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
  <div class="container mt-4">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
      <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand" href="#">Gestión de Personal</a>
        <button id="btnCerrarSesion" class="btn btn-outline-light btn-sm">Cerrar Sesión</button>
      </div>
    </nav>

    <div class="row">
      <!-- Formulario -->
      <div class="col-md-7">
        <h5>Agregar Funcionarios</h5>
        <form id="formFuncionario" action="guardar_funcionario.php" method="POST" enctype="multipart/form-data">
          <input type="text" class="form-control mb-1" name="id_documento" id="id_documento" placeholder="Documento" required maxlength="20" inputmode="numeric" pattern="\d+" title="Sólo se permiten números" />
          <input type="text" class="form-control mb-1" name="apellidos_nombres" placeholder="Apellidos y Nombres" required minlength="6" maxlength="255" oninput="this.value = this.value.toUpperCase();" />
          <input type="text" class="form-control mb-1" name="telefono_institucional" id="telefono_institucional" placeholder="Teléfono Institucional" maxlength="20" required inputmode="numeric" pattern="\d+" title="Sólo se permiten números" />
          <input type="text" class="form-control mb-1" name="profesion" placeholder="Profesión" maxlength="100" required />
          <textarea class="form-control mb-1" name="perfil" placeholder="Perfil" rows="1" required></textarea>
          <input type="text" class="form-control mb-1" name="cargo" placeholder="Cargo" maxlength="100" required />
          <input type="text" class="form-control mb-1" name="decreto" placeholder="Decreto" maxlength="100" required />
          <input type="url" class="form-control mb-1" name="enlace_sigep" placeholder="Enlace SIGEP" maxlength="255" required />
          <input type="email" class="form-control mb-1" name="correo_electronico_institucional" placeholder="Correo Institucional" required maxlength="255" />
          <input type="text" class="form-control mb-1" name="direccion" placeholder="Dirección" maxlength="255" required />

          <label for="horario_trabajo" class="form-label">Horario de Trabajo</label>
          <select class="form-control mb-1" name="horario_trabajo" id="horario_trabajo" required>
            <option value="" disabled selected>Selecciona el horario</option>
            <option value="Lunes a viernes de 7:00 a.m. a 12:00 p.m. y 2:00 p.m. a 5:00 p.m.">
              Lunes a viernes de 7:00 a.m. a 12:00 p.m. y 2:00 p.m. a 5:00 p.m.
            </option>
            <option value="Lunes a viernes de 8:00 a.m. a 12:30 p.m. y de 2:00 p.m. a 6:00 p.m.">
              Lunes a viernes de 8:00 a.m. a 12:30 p.m. y de 2:00 p.m. a 6:00 p.m.
            </option>
            <option value="Lunes a jueves de 8:00 a.m. a 12:30 p.m. y 2:00 p.m. a 6:00 p.m. y viernes de 8:00 a.m. a 12:30 p.m. y 2:00 p.m. a 5:00 p.m.">
              Lunes a jueves de 8:00 a.m. a 12:30 p.m. y 2:00 p.m. a 6:00 p.m. y viernes de 8:00 a.m. a 12:30 p.m. y 2:00 p.m. a 5:00 p.m.
            </option>
          </select>

          <label for="foto_funcionario" class="form-label mt-2">Foto del Funcionario</label>
          <input type="file" class="form-control mb-2" name="foto_funcionario" id="foto_funcionario" accept="image/*" />
          <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        </form>
      </div>

      <!-- Lista de Funcionarios -->
      <div class="col-md-5">
        <h5>Funcionarios Registrados</h5>
        <p id="contadorFuncionarios" class="text-muted">Total: 0 funcionario(s)</p>
        <div class="tabla-buscador-wrapper">
          <input type="text" id="buscadorFuncionarios" placeholder="🔍 Buscar funcionario..." />
          <div class="tabla-container">
            <table class="table table-hover table-striped" id="tablaFuncionarios">
              <thead>
                <tr>
                  <th>Apellidos y Nombres</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/validacion_formulario.js"></script>
  <script src="js/sesion.js"></script>
  <script src="js/funcionarios.js"></script>
</body>
</html>