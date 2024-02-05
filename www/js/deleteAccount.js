function confirmDelete() {
  // Récupérer le mot de passe saisi par l'utilisateur
  var confirmPassword = document.getElementById("confirmPassword").value;

  $.ajax({
    type: "POST",
    url: "/delete-account", // URL de votre backend pour la suppression du compte
    data: { password: confirmPassword },
    success: function (response) {
      // Traiter la réponse du backend (par exemple, afficher un message de succès)
      console.log(response);
    },
    error: function (error) {
      // Traiter les erreurs (par exemple, afficher un message d'erreur)
      console.error(error);
    },
  });
}
