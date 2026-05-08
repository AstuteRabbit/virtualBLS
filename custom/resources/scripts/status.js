//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

function getStatusKeyFromUrl() {
    const params = new URLSearchParams(window.location.search);
    return params.get('k') || '';
}

//Get the BLS time limit specified on the settings form
$('#myButton').on('click', function () {
    const timeout = $('#timeoutInput').val() || 10; // Default to 10 seconds if no input
    const statusKey = getStatusKeyFromUrl();

    if (!statusKey) {
        console.error('Missing status key in BLS URL.');
        return;
    }

    // Send button click status to the server
    $.ajax({
        url: 'status.php',
        method: 'POST',
        dataType: 'json',
        data: { timeout: timeout, statusKey: statusKey },
        success: function () {
            console.log('Button click sent to server');
        },
        error: function () {
            console.error('Failed to send button click');
        }
    });
});
