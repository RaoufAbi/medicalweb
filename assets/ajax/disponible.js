// Handle click events on "En cours" or "indisponible"
document.querySelectorAll('.status').forEach(function (statusElement) {
    statusElement.addEventListener('click', function () {
        const userId = this.getAttribute('data-userid');
        const currentStatus = this.classList.contains('delivered') ? 'delivered' : 'cancelled';
        const newStatus = currentStatus === 'delivered' ? 'cancelled' : 'delivered';

        // Set the new status text
        const newStatusText = newStatus === 'delivered' ? 'En cours' : 'indisponible';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../assets/php/phpAjax/disponible.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Prepare data for POST request
        const data = `user_id=${userId}&status=${newStatus}`;

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Update the status in the table row
                    statusElement.textContent = newStatusText;
                    statusElement.classList.remove(currentStatus);
                    statusElement.classList.add(newStatus);

                   
                } else {
                    alert('Error: ' + response.message);
                }
            } else {
                alert('Request failed with status: ' + xhr.status);
            }
        };

        xhr.send(data); // Send the request
    });
});
