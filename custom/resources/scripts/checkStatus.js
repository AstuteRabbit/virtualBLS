//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

function checkStatus() {
    // Poll the server for the button click status
    $.ajax({
        url: 'status.php',
        method: 'GET',
        success: function (response) {
            const data = JSON.parse(response);
            if (data.buttonClicked) {
                const message = 'BLS In Progress!';
                if (!document.getElementById('remoteMessage')) {
                    $('#settingsForm').append(`<div style="font-weight:bold;" id="remoteMessage">${message}</div>`);
                    console.log('Data Recieved and Message Added');
                }

                // Remove the message after the timeout
                setTimeout(() => {
                    $('#remoteMessage').remove();
                }, data.timeout * 1000);
            }
        },
        error: function () {
            console.error('Failed to fetch status');
        }
    });
}

// Poll the server every second
setInterval(checkStatus, 1000);
