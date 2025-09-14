// Ejecuta el código solo cuando el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Cargar la lista completa de funcionarios al cargar la página
    cargarFuncionarios();

    // Obtener el input del buscador de funcionarios
    const buscador = document.getElementById("buscadorFuncionarios");

    // Si el buscador existe, agregarle un listener para detectar la escritura
    if (buscador) {
        buscador.addEventListener("input", function () {
            const texto = buscador.value.toLowerCase(); 
            filtrarFuncionarios(texto); 
        });
    }
});

// Variable global para guardar la lista completa de funcionarios
let funcionariosGlobal = [];

/**
 * Carga la lista de funcionarios desde el servidor vía fetch
 */
function cargarFuncionarios() {
    fetch("listar_funcionarios.php")
        .then((response) => response.json()) 
        .then((data) => {
            if (data.status === "success") {
                funcionariosGlobal = data.data; 
                renderizarFuncionarios(funcionariosGlobal); 
            } else {
                console.error("Error al cargar funcionarios:", data.message);
            }
        })
        .catch((error) => {
            console.error("Error en la solicitud de funcionarios:", error);
        });
}

/**
 * Renderiza la lista de funcionarios en la tabla HTML
 * @param {Array} lista - Lista de funcionarios a mostrar
 */
function renderizarFuncionarios(lista) {
    const tbody = document.querySelector("#tablaFuncionarios tbody"); 
    const contador = document.getElementById("contadorFuncionarios"); 

    tbody.innerHTML = ""; 

    // Crear una fila por cada funcionario
    lista.forEach((f) => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td><a href="detalle_funcionario.php?id=${f.id}">${f.apellidos_nombres}</a></td>
            <td>
                <button class="btn btn-danger btn-sm"
                    onclick="eliminarFuncionario(${f.id}, '${f.apellidos_nombres}')">
                    Eliminar
                </button>
            </td>
        `;
        tbody.appendChild(fila);
    });

    // Mostrar la cantidad total de funcionarios renderizados
    if (contador) {
        contador.textContent = `Total: ${lista.length} funcionario(s)`;
    }
}

/**
 * Filtra la lista global de funcionarios según el texto ingresado
 * @param {string} texto - Texto de búsqueda
 */
function filtrarFuncionarios(texto) {
    const filtrados = funcionariosGlobal.filter((f) =>
        Object.values(f).some(
            (v) =>
                typeof v === "string" && 
                v.toLowerCase().includes(texto) // 
        )
    );

    renderizarFuncionarios(filtrados);
}

/**
 * Elimina un funcionario por su ID, con confirmación
 * @param {number} id - ID del funcionario a eliminar
 * @param {string} nombreCompleto - Nombre del funcionario 
 */
function eliminarFuncionario(id, nombreCompleto) {
    if (!confirm(`¿Estás seguro de que deseas eliminar a ${nombreCompleto}?`)) return;

    // Enviar solicitud de eliminación al servidor
    fetch(`eliminar_funcionario.php?id=${id}`, { method: 'GET' })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                mostrarAlerta(`${nombreCompleto} fue eliminado correctamente.`, 'success');
                cargarFuncionarios();
            } else {
                mostrarAlerta(`Error al eliminar a ${nombreCompleto}`, 'danger');
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarAlerta(`Error de red al eliminar a ${nombreCompleto}`, 'danger');
        });
}

/**
 * Función auxiliar para mostrar mensajes de alerta
 * @param {string} mensaje - Mensaje a mostrar
 * @param {string} tipo - Tipo de alerta ('success', 'danger', etc.)
 */
function mostrarAlerta(mensaje, tipo) {
    // Ejemplo básico de implementación:
    const alertBox = document.createElement("div");
    alertBox.className = `alert alert-${tipo}`;
    alertBox.textContent = mensaje;

    // Agregar al DOM, en algún contenedor visible
    const container = document.getElementById("alertContainer");
    if (container) {
        container.appendChild(alertBox);
        // Ocultar automáticamente después de unos segundos
        setTimeout(() => container.removeChild(alertBox), 4000);
    } else {
        alert(mensaje); 
    }
}