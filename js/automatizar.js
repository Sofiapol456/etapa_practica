document.addEventListener('DOMContentLoaded', function () {

  // Crear alerta
  const alertDiv = document.createElement('div');
  alertDiv.className = 'alert';
  alertDiv.style.display = 'none';
  alertDiv.style.position = 'fixed';
  alertDiv.style.top = '10px';
  alertDiv.style.right = '10px';
  alertDiv.style.zIndex = '9999';
  document.body.appendChild(alertDiv);

  function mostrarAlerta(mensaje, tipo = 'success') {
    alertDiv.textContent = mensaje;
    alertDiv.className = `alert alert-${tipo}`;
    alertDiv.style.display = 'block';
    setTimeout(() => alertDiv.style.display = 'none', 3000);
  }

  // Actualiza la tabla según la sección visible
  function autoRecargarDatos() {
    const seccionFuncionarios = document.getElementById('seccionFuncionarios');
    if (seccionFuncionarios && seccionFuncionarios.style.display === 'block') {
      if (typeof cargarFuncionarios === 'function') {
        cargarFuncionarios();
      }
    } else {
      if (typeof cargarSecretarios === 'function') {
        cargarSecretarios();
      }
    }
  }

  // Auto refresh cada 60 segundos (opcional)
  setInterval(autoRecargarDatos, 60000);

  // Interceptar formulario
  const interceptarEnvio = (form, tipo) => {
    form.addEventListener('submit', function (e) {
      e.preventDefault(); // Previene recarga

      const formData = new FormData(form);

      fetch(form.action, {
        method: form.method,
        body: formData
      })
        .then(response => response.text())
        .then(texto => {
          console.log("Respuesta del servidor:", texto);

          if (texto.toLowerCase().includes('correctamente')) {
            mostrarAlerta(`${tipo} guardado correctamente`);
            form.reset(); // ✅ BORRA el formulario

            if (tipo === 'Funcionario') {
              if (typeof cargarFuncionarios === 'function') {
                cargarFuncionarios(); // ✅ Refresca tabla
              }
            } else {
              if (typeof cargarSecretarios === 'function') {
                cargarSecretarios(); // ✅ Refresca tabla
              }
            }
          } else {
            mostrarAlerta(`Error al guardar ${tipo.toLowerCase()}`, 'danger');
          }
        })
        .catch(error => {
          console.error('Error al enviar formulario:', error);
          mostrarAlerta(`Error al guardar ${tipo.toLowerCase()}`, 'danger');
        });
    });
  };

  // Aplica a ambos formularios
  const formFuncionario = document.getElementById('formFuncionario');
  const formSecretario = document.getElementById('formSecretario');

  if (formFuncionario) interceptarEnvio(formFuncionario, 'Funcionario');
  if (formSecretario) interceptarEnvio(formSecretario, 'Secretario');
});