<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Gestión de Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/estilos.css" />
</head>

<body>
    <div class="container">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav nav nav-underline me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a id="btnFuncionarios" class="nav-link" href="#">Funcionarios</a>
                        </li>
                        <li class="nav-item">
                            <a id="btnSecretarios" class="nav-link" href="#">Secretarios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sección Funcionarios -->
        <div id="seccionFuncionarios" style="margin-top: 20px;">
            <div class="row">

                <!-- Formulario Agregar Funcionarios -->
                <div class="col-md-7">
                    <h5>Agregar Funcionarios</h5>
                    <form id="formFuncionario" action="guardar_funcionario.php" method="POST">
                        <input type="text" class="form-control mb-1" placeholder="Apellidos y Nombres" name="apellidos_nombres"
                            required maxlength="255" />
                        <input type="text" class="form-control mb-1" placeholder="Teléfono Institucional" name="telefono_institucional"
                            maxlength="20" />
                        <input type="text" class="form-control mb-1" placeholder="Profesión" name="profesion" maxlength="100" />
                        <textarea class="form-control mb-1" placeholder="Perfil" name="perfil" rows="1"></textarea>
                        <input type="text" class="form-control mb-1" placeholder="Cargo" name="cargo" maxlength="100" />
                        <input type="text" class="form-control mb-1" placeholder="Decreto" name="decreto" maxlength="100" />
                        <input type="url" class="form-control mb-1" placeholder="Enlace SIGEP" name="enlace_sigep" maxlength="255" />
                        <input type="email" class="form-control mb-1" placeholder="Correo Institucional" name="correo_electronico_institucional"
                            maxlength="255" />
                        <input type="text" class="form-control mb-1" placeholder="Dirección" name="direccion" maxlength="255" />
                        <input type="text" class="form-control mb-1" placeholder="Horario" name="horario_trabajo" maxlength="100" />
                        <input type="url" class="form-control mb-1" placeholder="Enlace Foto" name="enlace_foto" maxlength="255" />
                        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                    </form>
                </div>

                <!-- Lista Funcionarios Registrados -->
                <div class="col-md-5">
                    <h5>Funcionarios Registrados</h5>
                    <p id="contadorFuncionarios" class="text-muted">Total: 0 funcionario(s)</p>
                    <input type="text" id="buscadorFuncionarios" placeholder="🔍 Buscar funcionario..."
                        style="width: 100%; padding: 10px 15px; font-size: 16px; border: 2px solid #ced4da; border-radius: 8px; background-color: #fff; box-shadow: inset 0 1px 2px rgba(196, 45, 45, 0.1); transition: all 0.3s ease-in-out; margin-bottom: 10px;"
                        onfocus="this.style.borderColor='#0d6efd'; this.style.boxShadow='0 0 5px rgba(13,110,253,0.4)'"
                        onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='inset 0 1px 2px rgba(0,0,0,0.1)'" />
                    <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc;">
                        <table class="table table-hover table-striped" id="tablaFuncionarios">
                            <thead style="position: sticky; top: 0; background-color: #f8f9fa;">
                                <tr>
                                    <th scope="col">Apellidos y Nombres</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección Secretarios -->
        <div id="seccionSecretarios" style="margin-top: 20px;">
            <div class="row">

                <!-- Formulario Agregar Secretarios -->
                <div class="col-md-7">
                    <h5>Agregar Secretarios</h5>
                    <form id="formSecretario" action="guardar_secretario.php" method="POST">
                        <input type="text" class="form-control mb-1" placeholder="Apellidos y Nombres" name="apellidos_nombres"
                            required maxlength="255" />
                        <input type="text" class="form-control mb-1" placeholder="Teléfono Institucional" name="telefono_institucional"
                            maxlength="20" />
                        <input type="text" class="form-control mb-1" placeholder="Profesión" name="profesion" maxlength="100" />
                        <textarea class="form-control mb-1" placeholder="Perfil" name="perfil" rows="1"></textarea>
                        <input type="text" class="form-control mb-1" placeholder="Cargo" name="cargo" maxlength="100" />
                        <input type="text" class="form-control mb-1" placeholder="Decreto" name="decreto" maxlength="100" />
                        <input type="url" class="form-control mb-1" placeholder="Enlace SIGEP" name="enlace_sigep" maxlength="255" />
                        <input type="email" class="form-control mb-1" placeholder="Correo Institucional" name="correo_electronico_institucional"
                            maxlength="255" />
                        <input type="text" class="form-control mb-1" placeholder="Dirección" name="direccion" maxlength="255" />
                        <input type="text" class="form-control mb-1" placeholder="Horario" name="horario_trabajo" maxlength="100" />
                        <input type="url" class="form-control mb-1" placeholder="Enlace Foto" name="enlace_foto" maxlength="255" />
                        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                    </form>
                </div>

                <!-- Lista Secretarios Registrados -->
                <div class="col-md-5">
                    <h5>Secretarios Registrados</h5>
                    <p id="contadorSecretarios" class="text-muted">Total: 0 secretario(s)</p>
                    <input type="text" id="buscadorSecretarios" placeholder="🔍 Buscar secretario..."
                        style="width: 100%; padding: 10px 15px; font-size: 16px; border: 2px solid #ced4da; border-radius: 8px; background-color: #fff; box-shadow: inset 0 1px 2px rgba(196, 45, 45, 0.1); transition: all 0.3s ease-in-out; margin-bottom: 10px;"
                        onfocus="this.style.borderColor='#0d6efd'; this.style.boxShadow='0 0 5px rgba(13,110,253,0.4)'"
                        onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='inset 0 1px 2px rgba(0,0,0,0.1)'" />
                    <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc;">
                        <table class="table table-hover table-striped" id="tablaSecretarios">
                            <thead style="position: sticky; top: 0; background-color: #f8f9fa;">
                                <tr>
                                    <th scope="col">Apellidos y Nombres</th>
                                    <th scope="col">Acciones</th>
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
    <script src="js/funcionarios.js"></script>
    <script src="js/secretarios.js"></script>
    <script src="js/main.js"></script>
    <script src="js/automatizar.js"></script>
</body>
</html>