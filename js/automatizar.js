// Espera a que todo el contenido del DOM esté cargado antes de ejecutar el script
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

    // Función global para mostrar una alerta con mensaje
    window.mostrarAlerta = function (mensaje, tipo = 'success') {
        alertDiv.textContent = mensaje;                     
        alertDiv.className = `alert alert-${tipo}`;         
        alertDiv.style.display = 'block';                   
        setTimeout(() => alertDiv.style.display = 'none', 3000); 
    }

    // Función que recarga automáticamente los datos según qué sección esté visible
    function autoRecargarDatos() {
        const seccionFuncionarios = document.getElementById('seccionFuncionarios');
        if (seccionFuncionarios && seccionFuncionarios.style.display === 'block') {
            // Si la sección de funcionarios está visible, recarga los funcionarios
            if (typeof cargarFuncionarios === 'function') {
                cargarFuncionarios();
            }
        } else {
            // Si no está visible, recarga los secretarios
            if (typeof cargarSecretarios === 'function') {
                cargarSecretarios();
            }
        }
    }

    // Llama a la función anterior cada 60 segundos 
    setInterval(autoRecargarDatos, 60000);

    // Función para interceptar el envío de formularios y manejarlo con fetch 
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
                console.log("Respuesta del servidor:", texto);
                // Si la respuesta contiene la palabra 'correctamente', se considera éxito
                if (texto.toLowerCase().includes('correctamente')) {
                    mostrarAlerta(`${tipo} guardado correctamente`); 
                    form.reset(); 
                    // Recarga los datos según el tipo
                    if (tipo === 'Funcionario') {
                        if (typeof cargarFuncionarios === 'function') {
                            cargarFuncionarios();
                        }
                    } else {
                        if (typeof cargarSecretarios === 'function') {
                            cargarSecretarios();
                        }
                    }
                } else {
                    // Si no contiene "correctamente", muestra error
                    mostrarAlerta(`Error al guardar ${tipo.toLowerCase()}`, 'danger');
                }
            })
            .catch(error => {
                // Manejo de errores si falla el fetch
                console.error('Error al enviar formulario:', error);
                mostrarAlerta(`Error al guardar ${tipo.toLowerCase()}`, 'danger');
            });
        });
    };

    // Obtiene los formularios por ID
    const formFuncionario = document.getElementById('formFuncionario');
    const formSecretario = document.getElementById('formSecretario');

    // Aplica la función de interceptar envío si los formularios existen
    if (formFuncionario) interceptarEnvio(formFuncionario, 'Funcionario');
    if (formSecretario) interceptarEnvio(formSecretario, 'Secretario');
});