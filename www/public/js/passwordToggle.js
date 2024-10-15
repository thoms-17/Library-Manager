function initPasswordToggle() {
  const passwordField = document.getElementById("password");
  const togglePasswordButton = document.getElementById("togglePassword");

  togglePasswordButton.addEventListener("click", function () {
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
    eyeIcon.className = type === "password" ? "fa fa-eye-slash" : "fa fa-eye";
  });
}

// Appel de la fonction lors du chargement de la page
document.addEventListener("DOMContentLoaded", function () {
  initPasswordToggle();
});
