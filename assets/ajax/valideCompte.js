// Handle click events on "Accepter" and "Refuser"
document.querySelectorAll('.status').forEach(function (statusElement) {
    statusElement.addEventListener('click', function () {
        const userId = this.closest('tr').querySelector('td:first-child').textContent.trim();
        const action = this.classList.contains('delivered') ? 'accept' : 'delete';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../assets/php/phpAjax/valideCompte.php', true);
        
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        // Prepare data for POST request
        const data = `action=${action}&user_id=${userId}`;

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    const row = statusElement.closest('tr');
                    
                    if (action === 'delete') {
                        // If user is deleted, show an alert and remove the row
                        alert('User deleted successfully');
                        
                        // Remove the row from the table
                        row.remove();
                    } else {
                        // If user is accepted, show an alert
                        alert('User accepted successfully');
                        row.remove();
                    }
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
