//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

// Track if form has changed
let formChanged = false;
const settingsForm = document.getElementById('settingsForm');    

function submitFormData() {
    const formData = new FormData(settingsForm);
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
    formChanged = false;
}

// Listen for changes on the form
settingsForm.addEventListener('input', function() {
    formChanged = true;
});
settingsForm.addEventListener('change', function() {
    formChanged = true;
});

// Submit on blur or after a short debounce
settingsForm.addEventListener('blur', function(e) {
    if (formChanged) {
        submitFormData();
    }
}, true);

// Submit when the user clicks the submit button   
settingsForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (formChanged) {
        submitFormData();
    }
});

// Stop button logic to set refresh flag and trigger page reload in bls.php after 1 second, allowing form data to be re-submitted with refresh flag set to false. This ensures the page reloads with the latest settings applied.
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
            // Wait 1 second before submitting form data
            setTimeout(function() {
                submitFormData();
                console.log('form re-submitted');
            }, 1000);
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
            // Wait 1 second before calling blsRefreshed
            setTimeout(function() {
                blsRefreshed();
            }, 1000);
        },
        error: function(xhr, status, error) {
            console.error('Error setting refresh flag:', error);
        }
    });
    
};
  