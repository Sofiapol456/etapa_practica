// Espera a que todo el contenido del DOM esté cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {
    // Carga la lista de secretarios desde el servidor
    cargarSecretarios();

    // Obtiene el input del buscador por su ID
    const buscador = document.getElementById("buscadorSecretarios");
    if (buscador) {
        // Agrega un evento para filtrar los secretarios conforme se escribe en el buscador
        buscador.addEventListener("input", function () {
            // Convierte el texto a minúsculas para búsqueda insensible a mayúsculas
            const texto = buscador.value.toLowerCase();
            filtrarSecretarios(texto);
        });
    }
});

// Variable global para almacenar la lista completa de secretarios
let secretariosGlobal = [];

// Función para cargar los secretarios desde el servidor usando fetch
function cargarSecretarios() {
    fetch("listar_secretarios.php")
        .then((response) => response.json()) // Convierte la respuesta a JSON
        .then((data) => {
            // Verifica si la respuesta fue exitosa
            if (data.status === "success") {
                // Guarda la lista completa en la variable global
                secretariosGlobal = data.data;
                // Renderiza la lista completa en la tabla
                renderizarSecretarios(secretariosGlobal);
            } else {
                // Muestra error en consola si la respuesta no fue exitosa
                console.error("Error al cargar secretarios:", data.message);
            }
        })
        .catch((error) => {
            // Muestra error en consola si hubo un problema con la solicitud
            console.error("Error en la solicitud de secretarios:", error);
        });
}

// Función para mostrar los secretarios en la tabla HTML
function renderizarSecretarios(lista) {
    // Obtiene el cuerpo de la tabla donde se van a agregar las filas
    const tbody = document.querySelector("#tablaSecretarios tbody");
    // Obtiene el elemento donde se mostrará el contador total
    const contador = document.getElementById("contadorSecretarios");

    // Limpia las filas anteriores
    tbody.innerHTML = "";

    // Por cada secretario en la lista, crea una fila con sus datos
    lista.forEach((s) => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td><a href="detalle_secretario.php?id=${s.id}">${s.apellidos_nombres}</a></td>
            <td><button class="btn btn-danger btn-sm" onclick="eliminarSecretario(${s.id}, '${s.apellidos_nombres}')">Eliminar</button></td>
        `;
        tbody.appendChild(fila); // Agrega la fila a la tabla
    });

    // Actualiza el contador con el número total de secretarios mostrados
    if (contador) {
        contador.textContent = `Total: ${lista.length} secretario(s)`;
    }
}

// Función para filtrar los secretarios según el texto de búsqueda
function filtrarSecretarios(texto) {
    // Filtra la lista global buscando coincidencias en cualquier valor string de cada objeto
    const filtrados = secretariosGlobal.filter((s) =>
        Object.values(s).some(
            (v) => typeof v === "string" && v.toLowerCase().includes(texto)
        )
    );
    // Renderiza solo los secretarios filtrados
    renderizarSecretarios(filtrados);
}

// Función para eliminar un secretario por ID, tras confirmación del usuario
function eliminarSecretario(id, nombreCompleto) {
    // Pregunta al usuario si está seguro de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar a ${nombreCompleto}?`)) return;

    // Realiza la petición para eliminar al secretario
    fetch(`eliminar_secretario.php?id=${id}`, { method: 'GET' })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Si fue exitoso, muestra alerta y recarga la lista
                mostrarAlerta(`${nombreCompleto} fue eliminado correctamente.`, 'success');
                cargarSecretarios();
            } else {
                // Si hubo error, muestra alerta de error
                mostrarAlerta(`Error al eliminar a ${nombreCompleto}`, 'danger');
            }
        })
        .catch(error => {
            // Muestra alerta si hay error de red o en la solicitud
            console.error("Error:", error);
            mostrarAlerta(`Error de red al eliminar a ${nombreCompleto}`, 'danger');
        });
}