//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

//variables for the form
const form = document.getElementById('settingsForm');
const urlDisplay = document.getElementById('URL');

const copy = document.getElementById("copy");
const start = document.getElementById("start");

//submit form data
form.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the default form submission
copy.style.display = 'block';
start.style.display = 'block';
  // Get the form values
  const timeout = document.getElementById('timeout').value;
  const background = document.getElementById('background').value;
  const target = document.getElementById('target').value;
});

// copy URL to clipboard
copy.addEventListener("click", function() {
  const copiedText = document.getElementById("URL").textContent;
  const decodedText = decodeURIComponent(copiedText);

  navigator.clipboard.writeText(decodedText)
    .then(() => {
      alert("Text copied to clipboard");
    })
    .catch((err) => {
      console.error("Failed to copy text: ", err);
    });
});
//start the BLS activity in a new tab
start.addEventListener("click", function() {
  const encodedUrl = document.getElementById("URL").textContent;
  const decodedUrl = decodeURIComponent(encodedUrl);

  window.location.href = decodedUrl;
});
