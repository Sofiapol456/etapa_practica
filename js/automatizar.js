// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function () {

  // Crea un div para mostrar alertas en pantalla
  const alertDiv = document.createElement('div');
  alertDiv.className = 'alert';
  alertDiv.style.display = 'none';
  alertDiv.style.position = 'fixed';
  alertDiv.style.top = '10px';
  alertDiv.style.right = '10px';
  alertDiv.style.zIndex = '9999';
  document.body.appendChild(alertDiv);

  // Función para mostrar una alerta con mensajes
  function mostrarAlerta(mensaje, tipo = 'success') {
    alertDiv.textContent = mensaje;
    alertDiv.className = `alert alert-${tipo}`;
    alertDiv.style.display = 'block';
    setTimeout(() => alertDiv.style.display = 'none', 3000);
  }

  // Función para recargar automáticamente datos según la sección visible
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

  // Ejecuta autoRecargarDatos cada 60 segundos
  setInterval(autoRecargarDatos, 60000);

  // Intercepta el envío de formularios para mostrar una alerta después del envío
  const interceptarEnvio = (form, tipo) => {
    form.addEventListener('submit', function (e) {
      e.preventDefault(); 

      const formData = new FormData(form);

      fetch(form.action, {
        method: form.method,
        body: formData
      })
      .then(response => response.text())
      .then(texto => {
        if (texto.toLowerCase().includes('correctamente')) {
          mostrarAlerta(`${tipo} guardado correctamente`);
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

  // Obtiene los formularios por ID
  const formFuncionario = document.getElementById('formFuncionario');
  const formSecretario = document.getElementById('formSecretario');

  // Si existen, intercepta sus envíos para mostrar alertas personalizadas
  if (formFuncionario) interceptarEnvio(formFuncionario, 'Funcionario');
  if (formSecretario) interceptarEnvio(formSecretario, 'Secretario');
});