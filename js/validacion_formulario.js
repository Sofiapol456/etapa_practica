document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formFuncionario");

  form.addEventListener("submit", function (e) {
    const documento = form.id_documento.value.trim();
    const nombre = form.apellidos_nombres.value.trim();
    const telefono = form.telefono_institucional.value.trim();
    const email = form.correo_electronico_institucional.value.trim();
    const horario = form.horario_trabajo.value;

    // Validar documento sólo números y mínimo 5 caracteres
    if (!/^\d{5,}$/.test(documento)) {
      alert("El documento debe contener solo números y al menos 5 dígitos.");
      e.preventDefault();
      return;
    }

    // Validar nombre (mínimo 6 caracteres)
    if (nombre.length < 6) {
      alert("El campo 'Apellidos y Nombres' debe tener al menos 6 caracteres.");
      e.preventDefault();
      return;
    }

    // Validar teléfono sólo números
    if (!/^\d+$/.test(telefono)) {
      alert("El Teléfono Institucional solo debe contener números.");
      e.preventDefault();
      return;
    }

    // Validar email básico
    if (!email.includes("@") || !email.includes(".")) {
      alert("El correo electrónico no parece válido.");
      e.preventDefault();
      return;
    }

    // Validar selección de horario
    if (!horario) {
      alert("Por favor, selecciona un horario de trabajo.");
      e.preventDefault();
      return;
    }

    // Validar formato de archivo si cargan imagen
    const fileInput = document.getElementById("foto_funcionario");
    if (fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
      if (!allowedTypes.includes(file.type)) {
        alert("Solo se permiten imágenes en formato JPEG o PNG.");
        e.preventDefault();
        return;
      }
    }
  });

  // Evitar que se escriban letras en campo documento
  const documentoInput = document.getElementById("id_documento");
  documentoInput.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, ""); // Elimina todo lo que no sea número
  });

  // Evitar que se escriban letras en campo teléfono
  const telefonoInput = document.getElementById("telefono_institucional");
  telefonoInput.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");
  });
});