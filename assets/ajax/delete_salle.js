document.addEventListener('DOMContentLoaded', function () {
    let salleIdToDelete;
    const deleteModal = document.getElementById('deleteModal');
    const bluer = document.getElementById('AllComp');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const confirmDeleteButton = document.getElementById('confirmDelete');
    const cancelDeleteButton = document.getElementById('cancelDelete');

    // Show modal when delete button is clicked
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            salleIdToDelete = this.getAttribute('data-Selle_id-delete');
            console.log("Salle ID to delete:", salleIdToDelete);  // Debugging
            deleteModal.classList.add('active');
            bluer.classList.add('active');
        });
    });

    // Perform deletion on "Yes"
    confirmDeleteButton.addEventListener('click', function () {
        if (salleIdToDelete) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../assets/php/phpAjax/delete_salle.php', true);

            // Create form data for sending
            const formData = new FormData();
            formData.append('Salle_ID', salleIdToDelete);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log("Response from server:", response);  // Debugging

                    if (response.success) {
                        bluer.classList.remove('active');
                        deleteModal.classList.remove('active');

                        // Remove the row from the DOM
                        const row = document.querySelector(`[data-Selle_id-delete="${salleIdToDelete}"]`).closest('tr');
                        if (row) row.remove();

                        // alert('salle deleted successfully!');
                    } else {
                        alert('Failed to delete salle: ' + response.message);
                    }
                } else {
                    alert('Error during deletion: ' + xhr.status);
                }
            };

            xhr.send(formData);
        }
    });

    // Close modal on "No"
    cancelDeleteButton.addEventListener('click', function () {
        deleteModal.classList.remove('active');
        bluer.classList.remove('active');
    });
});
