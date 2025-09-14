// Espera a que todo el contenido del DOM se cargue antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {
  
  // Obtener referencias a las secciones y botones por sus IDs
  const seccionFuncionarios = document.getElementById("seccionFuncionarios");
  const seccionSecretarios = document.getElementById("seccionSecretarios");

  const btnFuncionarios = document.getElementById("btnFuncionarios");
  const btnSecretarios = document.getElementById("btnSecretarios");

  // Función para mostrar la sección de Funcionarios y ocultar la de Secretarios
  function mostrarSeccionFuncionarios() {
    seccionFuncionarios.style.display = "block";  // Mostrar Funcionarios
    seccionSecretarios.style.display = "none";    // Ocultar Secretarios
  }

  // Función para mostrar la sección de Secretarios y ocultar la de Funcionarios
  function mostrarSeccionSecretarios() {
    seccionFuncionarios.style.display = "none";   // Ocultar Funcionarios
    seccionSecretarios.style.display = "block";   // Mostrar Secretarios
  }

  // Al hacer clic en el botón de Funcionarios, prevenir el comportamiento por defecto (como un enlace)
  // y mostrar la sección de Funcionarios
  btnFuncionarios.addEventListener("click", function (e) {
    e.preventDefault();
    mostrarSeccionFuncionarios();
  });

  // Al hacer clic en el botón de Secretarios, prevenir el comportamiento por defecto y mostrar la sección de Secretarios
  btnSecretarios.addEventListener("click", function (e) {
    e.preventDefault();
    mostrarSeccionSecretarios();
  });

  // Mostrar inicialmente la sección de Funcionarios cuando carga la página
  mostrarSeccionFuncionarios();
});