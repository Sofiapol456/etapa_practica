<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Personal</title>
  
  <!-- Bootstrap  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Carga una hoja de estilos personalizada -->
  <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
  <div class="container">
    <!-- Barra de navegación para seleccionar entre Funcionarios y Secretarios -->
    <nav class="navbar navbar-expand-lg navbar-custom bg-primary">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenedor de enlaces de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav nav nav-underline me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <!-- Botón para mostrar la sección de Funcionarios -->
              <a id="btnFuncionarios" class="nav-link" href="#">Funcionarios</a>
            </li>
            <li class="nav-item">
              <!-- Botón para mostrar la sección de Secretarios -->
              <a id="btnSecretarios" class="nav-link" href="#">Secretarios</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Sección de Funcionarios -->
    <div id="seccionFuncionarios">
      <div class="row">
        <!-- Formulario para agregar funcionarios -->
        <div class="col-md-7">
          <br />
          <h5>Agregar Funcionarios</h5>
          <form id="formFuncionario" class="d-flex flex-column" action="guardar_funcionario.php" method="POST">
            <input type="text" class="form-control mb-1" placeholder="Apellidos y Nombres" name="apellidos_nombres" required maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Teléfono Institucional" name="telefono_institucional" maxlength="20" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Profesión" name="profesion" maxlength="100" />
            <div class="mensaje-error"></div>

            <textarea class="form-control mb-1" placeholder="Perfil" name="perfil" rows="1" style="resize: none;"></textarea>
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Cargo" name="cargo" maxlength="100" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Decreto" name="decreto" maxlength="100" />
            <div class="mensaje-error"></div>

            <input type="url" class="form-control mb-1" placeholder="Enlace SIGEP" name="enlace_sigep" maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="email" class="form-control mb-1" placeholder="Correo Institucional" name="correo_electronico_institucional" maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Dirección" name="direccion" maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Horario" name="horario_trabajo" maxlength="100" />
            <div class="mensaje-error"></div>

            <input type="url" class="form-control mb-1" placeholder="Enlace Foto" name="enlace_foto" maxlength="255" />
            <div class="mensaje-error"></div>

            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>

        <!-- Tabla para mostrar los funcionarios registrados -->
        <div class="col-md-5">
          <br />
          <h5>Funcionarios Registrados</h5>
          <table class="table table-striped" id="tablaFuncionarios">
            <thead>
              <tr>
                <th>N</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody></tbody> 
          </table>
        </div>
      </div>
    </div>

    <!-- Sección de Secretarios -->
    <div id="seccionSecretarios" style="display: none;">
      <div class="row">
        <!-- Formulario para agregar secretarios -->
        <div class="col-md-7">
          <br />
          <h5>Agregar Secretarios</h5>
          <form id="formSecretario" class="d-flex flex-column" action="guardar_secretarios.php" method="POST">
            <input type="text" class="form-control mb-1" placeholder="Apellidos y Nombres" name="apellidos_nombres" required maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Teléfono Institucional" name="telefono_institucional" maxlength="20" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Profesión" name="profesion" maxlength="100" />
            <div class="mensaje-error"></div>

            <textarea class="form-control mb-1" placeholder="Perfil" name="perfil" rows="1" style="resize: none;"></textarea>
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Cargo" name="cargo" maxlength="100" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Decreto" name="decreto" maxlength="100" />
            <div class="mensaje-error"></div>

            <input type="url" class="form-control mb-1" placeholder="Enlace SIGEP" name="enlace_sigep" maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="email" class="form-control mb-1" placeholder="Correo Institucional" name="correo_electronico_institucional" maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Dirección" name="direccion" maxlength="255" />
            <div class="mensaje-error"></div>

            <input type="text" class="form-control mb-1" placeholder="Horario" name="horario_trabajo" maxlength="100" />
            <div class="mensaje-error"></div>

            <input type="url" class="form-control mb-1" placeholder="Enlace Foto" name="enlace_foto" maxlength="255" />
            <div class="mensaje-error"></div>

            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>

        <!-- Tabla para mostrar los secretarios registrados -->
        <div class="col-md-5">
          <br />
          <h5>Secretarios Registrados</h5>
          <table class="table table-striped" id="tablaSecretarios">
            <thead>
              <tr>
                <th>N</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody></tbody> 
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Carga el JavaScript de Bootstrap para habilitar componentes interactivos -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Scripts de js -->
  <script src="js/main.js"></script>         
  <script src="js/funcionario.js"></script>  
  <script src="js/secretario.js"></script>
  <script src="js/automatizar.js"></script>   
</body>
</html>