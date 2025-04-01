document.addEventListener('DOMContentLoaded', function () {
    let userIdToDelete;
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
            userIdToDelete = this.getAttribute('data-userid');
            console.log("User ID to delete:", userIdToDelete);  // Debugging
            deleteModal.classList.add('active');
            bluer.classList.add('active');
        });
    });

    // Perform deletion on "Yes"
    confirmDeleteButton.addEventListener('click', function () {
        if (userIdToDelete) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../assets/php/phpAjax/delete_User.php', true);

            // Create form data for sending
            const formData = new FormData();
            formData.append('user_id', userIdToDelete);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log("Response from server:", response);  // Debugging

                    if (response.success) {
                        bluer.classList.remove('active');
                        deleteModal.classList.remove('active');

                        // Remove the row from the DOM
                        const row = document.querySelector(`[data-userid="${userIdToDelete}"]`).closest('tr');
                        if (row) row.remove();

                        // alert('User deleted successfully!');
                    } else {
                        alert('Failed to delete user: ' + response.message);
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
