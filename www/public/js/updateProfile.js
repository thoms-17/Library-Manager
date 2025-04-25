$(document).ready(function () {
  let cropper;
  let isEditing = false;

  // Activer/Désactiver le mode édition
  $("#editModeBtn").click(function () {
    isEditing = !isEditing;
    $("#infoDisplay").toggle(!isEditing);
    $("#editInfoForm").toggle(isEditing);
    $("#editImageBtn").toggle(isEditing);
  });

  $("#cancelEditBtn").click(function () {
    isEditing = false;
    $("#editInfoForm").hide();
    $("#infoDisplay").show();
    $("#editImageBtn").hide();
  });

  // Gérer la mise à jour du pseudo
  $("#editInfoForm").submit(function (event) {
    event.preventDefault();
    let newUsername = $("#editUsername").val();
    let fileInput = document.getElementById("profile-image");

    let formData = new FormData();
    formData.append("username", newUsername);

    if (fileInput.files.length > 0) {
      formData.append("profile_image", fileInput.files[0]);
    }

    $.ajax({
      url: "/account/update-info",
      type: "POST",
      data: formData,
      processData: false, // Important pour `FormData`
      contentType: false, // Important pour `FormData`
      success: function (response) {
        $("#usernameDisplay").text(newUsername);
        $("#infoDisplay").show();
        $("#editInfoForm").hide();
        isEditing = false;
      },
      error: function () {
        alert("Erreur lors de la mise à jour.");
      },
    });
  });

  // Ouvrir le sélecteur de fichiers uniquement si en mode édition
  $("#editImageBtn").click(function () {
    if (isEditing) {
      $("#profile-image").click();
    }
  });

  // Gérer la sélection et le recadrage d'image
  $("#profile-image").change(function (event) {
    let file = event.target.files[0];
    if (file) {
      let reader = new FileReader();
      reader.onload = function (e) {
        $("#imageToCrop").attr("src", e.target.result);
        $("#imageCropperModal").modal("show");

        cropper = new Cropper(document.getElementById("imageToCrop"), {
          aspectRatio: 1,
          viewMode: 1,
        });
      };
      reader.readAsDataURL(file);
    }
  });

  $("#cropImageBtn").click(function () {
    if (cropper) {
      let canvas = cropper.getCroppedCanvas();
      canvas.toBlob(function (blob) {
        let formData = new FormData();
        formData.append("profile_image", blob, "profile.jpg");

        $.ajax({
          url: "/account/update-info",
          type: "POST",
          data: formData,
          processData: false, // Important pour envoyer `FormData`
          contentType: false, // Important pour envoyer `FormData`
          success: function (response) {
            let newImageUrl = URL.createObjectURL(blob);
            $("#profilePreview").attr("src", newImageUrl);
            $("#imageCropperModal").modal("hide");
          },
          error: function () {
            alert("Erreur lors de la mise à jour de la photo.");
          },
        });
      }, "image/jpeg");
    }
  });
});
