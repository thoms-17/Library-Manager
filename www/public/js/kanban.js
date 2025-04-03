document.addEventListener("DOMContentLoaded", function () {
  const tasks = document.querySelectorAll(".list-group-item");
  const columns = document.querySelectorAll(".list-group");

  tasks.forEach((task) => {
    task.addEventListener("dragstart", function (event) {
      event.dataTransfer.setData("text/plain", task.dataset.id); // Sauvegarde l'ID de la tâche
      event.dataTransfer.effectAllowed = "move"; // Autorise le déplacement
    });
  });

  columns.forEach((column) => {
    // Empêche le comportement par défaut pour permettre le drop
    column.addEventListener("dragover", function (event) {
      event.preventDefault();
      event.dataTransfer.dropEffect = "move"; // Indiquer que le déplacement est permis
      column.classList.add("dragging-over"); // Ajouter feedback visuel
    });

    // Retirer le feedback visuel si l'élément quitte la zone de drop
    column.addEventListener("dragleave", function (event) {
      column.classList.remove("dragging-over");
    });

    // Gérer le drop
    column.addEventListener("drop", function (event) {
      event.preventDefault();
      column.classList.remove("dragging-over"); // Enlever le feedback visuel

      const id = event.dataTransfer.getData("text/plain");
      const taskElement = document.querySelector(`[data-id="${id}"]`);

      if (taskElement) {
        // Ajouter la tâche à la nouvelle colonne
        column.appendChild(taskElement);

        // Mettre à jour le statut de la tâche en fonction de la nouvelle colonne
        updateTaskStatus(taskElement.dataset.id, column.id);
      }
    });
  });
});

// Fonction pour envoyer la mise à jour du statut au serveur
function updateTaskStatus(taskId, newStatus) {
  // Conversion des ID de colonnes en statuts
  const statusMap = {
    todo: "to_do",
    "in-progress": "in_progress",
    done: "done",
  };

  // Vérifier si le statut correspond à une clé connue
  if (statusMap[newStatus]) {
    // Envoyer la requête au serveur pour mettre à jour le statut
    fetch(`/kanban/update-task/${taskId}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        status: statusMap[newStatus],
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Mettre à jour le statut dans la modal correspondante
          const modalStatusSelect = document.querySelector(
            `#editTaskModal-${taskId} select[name="status"]`
          );
          if (modalStatusSelect) {
            modalStatusSelect.value = statusMap[newStatus];
          } else {
            console.error(`La modal de la tâche ${taskId} n'a pas été trouvée`);
          }
        } else {
          console.error(
            "Erreur lors de la mise à jour du statut:",
            data.message
          );
        }
      })
      .catch((error) => {
        console.error("Erreur lors de la mise à jour du statut:", error);
      });
  } else {
    console.error("Statut non reconnu:", newStatus);
  }
}