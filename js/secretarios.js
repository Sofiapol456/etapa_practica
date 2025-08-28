document.addEventListener("DOMContentLoaded", function () {
  cargarSecretarios();
});

function cargarSecretarios() {
  fetch("listar_secretarios.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        const tbody = document.querySelector("#tablaSecretarios tbody");
        tbody.innerHTML = "";
        data.data.forEach((secretario, index) => {
          const fila = document.createElement("tr");
          fila.innerHTML = `
            <td>${index + 1}</td>
            <td>${secretario.apellidos_nombres}</td>
          `;
          tbody.appendChild(fila);
        });
      } else {
        console.error("Error al cargar secretarios:", data.message);
      }
    })
    .catch((error) => {
      console.error("Error en la solicitud de secretarios:", error);
    });
}