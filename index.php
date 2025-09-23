<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inicio de Sesión</title>
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form id="login-form" autocomplete="off">
      <label for="username">Usuario:</label>
      <input type="text" id="username" required />

      <label for="password">Contraseña:</label>
      <div class="password-wrapper">
        <input type="password" id="password" required />
        <span id="togglePassword" class="eye">👁️</span>
      </div>

      <div class="captcha-container">
        <canvas id="captchaCanvas" width="150" height="50" title="Haz clic para refrescar"></canvas>
        <input type="text" id="captchaInput" placeholder="Escribe las letras" required />
      </div>

      <button type="submit" id="submitBtn">Ingresar</button>
      <p id="message"></p>
    </form>
  </div>

  <script src="js/script.js"></script>
  <script src="js/sesion.js"></script> 
</body>
</html>