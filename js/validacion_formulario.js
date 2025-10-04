document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formFuncionario");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    const documento = form.id_documento.value.trim();
    const nombre = form.apellidos_nombres.value.trim();
    const telefono = form.telefono_institucional.value.trim();
    const email = form.correo_electronico_institucional.value.trim();
    const horario = form.horario_trabajo.value;

    if (!/^\d{5,}$/.test(documento)) {
      alert("El documento debe contener solo números y al menos 5 dígitos.");
      e.preventDefault();
      return;
    }

    if (nombre.length < 6) {
      alert("El campo 'Apellidos y Nombres' debe tener al menos 6 caracteres.");
      e.preventDefault();
      return;
    }

    if (!/^\d+$/.test(telefono)) {
      alert("El Teléfono Institucional solo debe contener números.");
      e.preventDefault();
      return;
    }

    if (!email.includes("@") || !email.includes(".")) {
      alert("El correo electrónico no parece válido.");
      e.preventDefault();
      return;
    }

    if (!horario) {
      alert("Por favor, selecciona un horario de trabajo.");
      e.preventDefault();
      return;
    }

    const fileInput = document.getElementById("foto_funcionario");
    if (fileInput && fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const allowedTypes = ["image/jpeg", "image/png"];
      const allowedExtensions = ["jpg", "jpeg", "png"];
      const fileType = file.type;
      const fileName = file.name.toLowerCase();
      const extension = fileName.substring(fileName.lastIndexOf(".") + 1);

      if (!allowedTypes.includes(fileType) && !allowedExtensions.includes(extension)) {
        alert("Solo se permiten imágenes en formato JPG, JPEG o PNG.");
        e.preventDefault();
        return;
      }
    }
  });

  const documentoInput = document.getElementById("id_documento");
  if (documentoInput) {
    documentoInput.addEventListener("input", function () {
      this.value = this.value.replace(/\D/g, "");
    });
  }

  const telefonoInput = document.getElementById("telefono_institucional");
  if (telefonoInput) {
    telefonoInput.addEventListener("input", function () {
      this.value = this.value.replace(/\D/g, "");
    });
  }
});