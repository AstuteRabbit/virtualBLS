// Add a function to submit form data
function submitFormData() {
    const formData = new FormData(form);
    $.ajax({
        url: './update-settings.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Settings updated successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error updating settings:', error);
        }
    });
}

// Set up an interval to submit form data every second
setInterval(submitFormData, 1000);

function blsRefreshed() {
    const formData = new FormData();
    formData.append('refresh', 'false');

    $.ajax({
        url: './update-settings.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Refresh flag removed successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error removing refresh flag:', error);
        }
    });
}

stop.onclick = function() {
    const formData = new FormData();
    formData.append('refresh', 'true');

    $.ajax({
        url: './update-settings.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Refresh flag set successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error setting refresh flag:', error);
        }
    });
    blsRefreshed();
};
