// Verifica si el usuario está logueado
function verificarSesion() {
  if (!sessionStorage.getItem("loggedIn")) {
    alert("No has iniciado sesión. Redirigiendo al login...");
    window.location.href = "index.php";
  }
}

// Verifica si ya hay sesión activa, redirige a personal.php
function verificarSesionEnLogin() {
  if (sessionStorage.getItem("loggedIn")) {
    alert("No has cerrado sesión. Redirigiendo a la página principal.");
    window.location.href = "personal.php";
  }
}

// Redirige al personal si ya está logueado
function redireccionarSiLogueado() {
  if (sessionStorage.getItem("loggedIn")) {
    window.location.href = "personal.php";
  }
}

// Manejo del login
function manejarLogin() {
  const form = document.getElementById("loginForm");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario").value;
    const contrasena = document.getElementById("contrasena").value;

    if (usuario === "admin" && contrasena === "1234") {
      sessionStorage.setItem("loggedIn", "true");
      window.location.href = "personal.php";
    } else {
      alert("Credenciales incorrectas.");
    }
  });
}

// Botón cerrar sesión
function configurarCerrarSesion() {
  const btnCerrar = document.getElementById("btnCerrarSesion");
  if (!btnCerrar) return;

  btnCerrar.addEventListener("click", function () {
    if (confirm("¿Estás seguro de que quieres cerrar sesión?")) {
      sessionStorage.removeItem("loggedIn");
      window.location.href = "index.php";
    }
  });
}

// Detecta la página y ejecuta lo necesario
document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("loginForm")) {
    redireccionarSiLogueado();
    manejarLogin();
  }

  if (document.getElementById("btnCerrarSesion")) {
    verificarSesion();
    configurarCerrarSesion();
  }
});