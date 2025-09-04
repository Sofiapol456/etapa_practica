document.addEventListener("DOMContentLoaded", function () {
  const seccionFuncionarios = document.getElementById("seccionFuncionarios");
  const seccionSecretarios = document.getElementById("seccionSecretarios");

  const btnFuncionarios = document.getElementById("btnFuncionarios");
  const btnSecretarios = document.getElementById("btnSecretarios");

  function mostrarSeccionFuncionarios() {
    seccionFuncionarios.style.display = "block";
    seccionSecretarios.style.display = "none";
  }

  function mostrarSeccionSecretarios() {
    seccionFuncionarios.style.display = "none";
    seccionSecretarios.style.display = "block";
  }

  btnFuncionarios.addEventListener("click", function (e) {
    e.preventDefault();
    mostrarSeccionFuncionarios();
  });

  btnSecretarios.addEventListener("click", function (e) {
    e.preventDefault();
    mostrarSeccionSecretarios();
  });

  mostrarSeccionFuncionarios();
});