let attempts = 3;
let lockTime = 60000;
let lockTimeout = null;

const validUser = "admin";
const validPassword = "12345";

const form = document.getElementById("login-form");
const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");
const message = document.getElementById("message");
const captchaCanvas = document.getElementById("captchaCanvas");
const captchaInput = document.getElementById("captchaInput");
const submitBtn = document.getElementById("submitBtn");

let captchaText = "";

togglePassword.addEventListener("click", () => {
  const type = passwordInput.type === "password" ? "text" : "password";
  passwordInput.type = type;
  togglePassword.textContent = type === "password" ? "👁️" : "🙈";
});

function generateCaptchaText(length = 5) {
  const chars = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
  let result = "";
  for (let i = 0; i < length; i++) {
    result += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  return result;
}

function drawCaptcha() {
  const ctx = captchaCanvas.getContext("2d");
  captchaText = generateCaptchaText();

  ctx.clearRect(0, 0, captchaCanvas.width, captchaCanvas.height);
  ctx.fillStyle = "#fff";
  ctx.fillRect(0, 0, captchaCanvas.width, captchaCanvas.height);

  ctx.font = "30px Arial";
  ctx.textBaseline = "middle";
  ctx.textAlign = "center";

  for (let i = 0; i < captchaText.length; i++) {
    const letter = captchaText[i];
    const x = 20 + i * 25;
    const y = 25;
    const angle = (Math.random() - 0.5) * 0.4;

    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(angle);
    ctx.fillStyle = "#000";
    ctx.fillText(letter, 0, 0);
    ctx.restore();
  }

  for (let i = 0; i < 3; i++) {
    ctx.beginPath();
    ctx.moveTo(Math.random() * 150, Math.random() * 50);
    ctx.lineTo(Math.random() * 150, Math.random() * 50);
    ctx.strokeStyle = "#ccc";
    ctx.stroke();
  }
}

form.addEventListener("submit", function (e) {
  e.preventDefault();

  if (lockTimeout) {
    message.textContent = "Demasiados intentos. Espera un minuto.";
    return;
  }

  const username = document.getElementById("username").value;
  const password = passwordInput.value;
  const captchaEntered = captchaInput.value.trim();

  if (captchaEntered !== captchaText) {
    message.style.color = "red";
    message.textContent = "Captcha incorrecto.";
    drawCaptcha();
    return;
  }

  if (username === validUser && password === validPassword) {
    message.style.color = "green";
    message.textContent = "¡Inicio de sesión exitoso!";
    sessionStorage.setItem("loggedIn", "true");
    setTimeout(() => {
      window.location.href = "personal.php";
    }, 1000);
  } else {
    attempts--;
    message.style.color = "red";
    if (attempts === 0) {
      message.textContent = "Bloqueado por 1 minuto.";
      submitBtn.disabled = true;
      lockTimeout = setTimeout(() => {
        attempts = 3;
        submitBtn.disabled = false;
        lockTimeout = null;
        message.textContent = "";
      }, lockTime);
    } else {
      message.textContent = `Credenciales incorrectas. Intentos restantes: ${attempts}`;
    }
  }
});

captchaCanvas.addEventListener("click", drawCaptcha);
drawCaptcha();