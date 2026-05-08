//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

function getStatusKey() {
    const params = new URLSearchParams(window.location.search);
    const fromUrl = params.get('k');
    if (fromUrl) {
        return fromUrl;
    }

    const fromStorage = localStorage.getItem('vbStatusKey');
    if (fromStorage) {
        return fromStorage;
    }

    const urlText = (document.getElementById('URL') || {}).textContent || '';
    if (urlText) {
        try {
            return new URL(urlText).searchParams.get('k') || '';
        } catch (e) {
            return '';
        }
    }

    return '';
}

let statusRequestInFlight = false;

function showRemoteMessage() {
    const message = 'BLS In Progress!';
    if (!document.getElementById('remoteMessage')) {
        $('#settingsForm').append(`<div style="font-weight:bold;" id="remoteMessage">${message}</div>`);
        console.log('Data Recieved and Message Added');
    }
}

function hideRemoteMessage() {
    $('#remoteMessage').remove();
}

function checkStatus() {
    const statusKey = getStatusKey();
    if (!statusKey || statusRequestInFlight) {
        return;
    }

    statusRequestInFlight = true;

    // Poll server for button click status
    $.ajax({
        url: 'status.php',
        method: 'GET',
        data: { statusKey: statusKey, _t: Date.now() },
        cache: false,
        dataType: 'json',
        success: function (response) {
            const data = response;
            if (data.buttonClicked) {
                showRemoteMessage();
            } else {
                hideRemoteMessage();
            }
        },
        error: function () {
            console.error('Failed to fetch status');
        },
        complete: function () {
            statusRequestInFlight = false;
        }
    });
}

// Poll the server once every second
setInterval(checkStatus, 1000);
