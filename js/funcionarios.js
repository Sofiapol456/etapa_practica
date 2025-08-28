document.addEventListener("DOMContentLoaded", function () {
  cargarFuncionarios();
});

function cargarFuncionarios() {
  fetch("listar_funcionarios.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        const tbody = document.querySelector("#tablaFuncionarios tbody");
        tbody.innerHTML = "";
        data.data.forEach((funcionario, index) => {
          const fila = document.createElement("tr");
          fila.innerHTML = `
            <td>${index + 1}</td>
            <td>${funcionario.apellidos_nombres}</td>
          `;
          tbody.appendChild(fila);
        });
      } else {
        console.error("Error al cargar funcionarios:", data.message);
      }
    })
    .catch((error) => {
      console.error("Error en la solicitud de funcionarios:", error);
    });
}