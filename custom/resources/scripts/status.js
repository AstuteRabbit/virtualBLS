//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

//Get the BLS time limit specified on the settings form
$('#myButton').on('click', function () {
    const timeout = $('#timeoutInput').val() || 10; // Default to 10 seconds if no input

    // Send the button click status to the server
    $.ajax({
        url: 'status.php',
        method: 'POST',
        data: { timeout: timeout },
        success: function () {
            console.log('Button click sent to server');
        },
        error: function () {
            console.error('Failed to send button click');
        }
    });
});
