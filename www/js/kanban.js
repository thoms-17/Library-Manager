document.addEventListener('DOMContentLoaded', function () {
    let kanbanItems = document.querySelectorAll('.kanban-items');
    
    kanbanItems.forEach(item => {
        new Sortable(item, {
            group: 'kanban',
            animation: 150,
            onEnd: function (evt) {
                let taskId = evt.item.getAttribute('data-id');
                let newStatus = evt.to.id; // ID of the target column
                fetch(`/kanban/update-task-status/${taskId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                });
            }
        });
    });
});
