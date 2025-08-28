// Espera a que el contenido del DOM esté completamente cargado antes de ejecutar el script
document.addEventListener("DOMContentLoaded", function () {
  // Se obtienen las referencias a las secciones que se mostrarán/ocultarán
  const seccionFuncionarios = document.getElementById("seccionFuncionarios");
  const seccionSecretarios = document.getElementById("seccionSecretarios");

  // Se obtienen los botones del menú o navegación
  const btnFuncionarios = document.getElementById("btnFuncionarios");
  const btnSecretarios = document.getElementById("btnSecretarios");

  // Función para mostrar la sección de funcionarios y ocultar la de secretarios
  function mostrarSeccionFuncionarios() {
    seccionFuncionarios.style.display = "block";
    seccionSecretarios.style.display = "none";
  }

  // Función para mostrar la sección de secretarios y ocultar la de funcionarios
  function mostrarSeccionSecretarios() {
    seccionFuncionarios.style.display = "none";
    seccionSecretarios.style.display = "block";
  }

  // Asignación de eventos de clic a los botones
  btnFuncionarios.addEventListener("click", function (e) {
    e.preventDefault(); // Previene el comportamiento por defecto del enlace o botón
    mostrarSeccionFuncionarios(); // Muestra la sección correspondiente
  });

  btnSecretarios.addEventListener("click", function (e) {
    e.preventDefault(); // Previene el comportamiento por defecto
    mostrarSeccionSecretarios(); // Muestra la sección correspondiente
  });

  // Muestra por defecto la sección de funcionarios al cargar la página
  mostrarSeccionFuncionarios();
});