document.addEventListener("DOMContentLoaded", () => {
    const content = document.getElementById("content");
    const navbarHeight = document.querySelector(".navbar").offsetHeight;
    content.style.paddingTop = `${navbarHeight + 16}px`;

    const addTaskModal = document.getElementById("addTaskModal");
    addTaskModal.addEventListener("show.bs.modal", (e) => {
        const btn = e.relatedTarget;
        const taskId = btn.getAttribute("data-list");
        document.getElementById("taskListId").value = taskId;
    });
});


// fitur edit
function editTask(id) {
    fetch(`/tasks/${id}/edit`)
        .then(response => response.json())
        .then(task => {
            document.getElementById('editTaskId').value = task.id;
            document.getElementById('editTaskName').value = task.name;
            document.getElementById('editTaskDescription').value = task.description;
            document.getElementById('editTaskPriority').value = task.priority;
            document.getElementById('editTaskForm').action = `/tasks/${task.id}`;
            new bootstrap.Modal(document.getElementById('editTaskModal')).show();
        })
        .catch(error => console.error('Error fetching task:', error));
}

