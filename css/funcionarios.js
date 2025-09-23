document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.querySelector("#tablaFuncionarios tbody");
  const buscador = document.querySelector("#buscadorFuncionarios");
  const contador = document.querySelector("#contadorFuncionarios");

  let funcionarios = [];

  const renderizar = (lista) => {
    tabla.innerHTML = "";
    lista.forEach(funcionario => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${funcionario.apellidos_nombres}</td>
        <td>
          <a href="detalle_funcionario.php?id_documento=${funcionario.id_documento}" class="btn btn-sm btn-info">Ver</a>
          <a href="editar_funcionario.php?id_documento=${funcionario.id_documento}" class="btn btn-sm btn-warning">Editar</a>
          <button class="btn btn-sm btn-danger btn-eliminar" data-id="${funcionario.id_documento}">Eliminar</button>
        </td>
      `;
      tabla.appendChild(fila);
    });
    contador.textContent = `Total: ${lista.length} funcionario(s)`;
  };

  const filtrar = (termino) => {
    const t = termino.toLowerCase();
    const filtrados = funcionarios.filter(f =>
      f.apellidos_nombres.toLowerCase().includes(t) ||
      f.id_documento.includes(t) ||
      f.cargo.toLowerCase().includes(t) ||
      f.perfil.toLowerCase().includes(t) ||
      f.fecha_ingreso.toLowerCase().includes(t)
    );
    renderizar(filtrados);
  };

  buscador.addEventListener("input", () => filtrar(buscador.value));

  fetch("obtener_funcionarios.php")
    .then(res => res.json())
    .then(data => {
      funcionarios = data;
      renderizar(funcionarios);
    });

  tabla.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-eliminar")) {
      const id = e.target.dataset.id;
      if (confirm("¿Eliminar funcionario?")) {
        fetch(`eliminar_funcionario.php?id_documento=${id}`)
          .then(res => res.text())
          .then(msg => {
            alert(msg);
            location.reload();
          });
      }
    }
  });
});