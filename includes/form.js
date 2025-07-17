const form = document.getElementById('settingsForm');
const urlDisplay = document.getElementById('URL');
const copy = document.getElementById("copy");
const start = document.getElementById("start");
const stop = document.getElementById("stop");

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    copy.style.display = 'block';
    start.style.display = 'block';
    stop.style.display = 'block';   
   
    
    // Construct the URL

    //const baseUrl = `${wpData.baseurl}/${wpData.userDir}`;
    //const url = `${baseUrl}/bls.html?`;
    
    // Update the content of the urlDisplay element with the generated URL
    //urlDisplay.textContent = `${url}`;

    // Get current URL and remove 'settings.html' if present
const currentUrl = window.location.href.replace('settings.php', '');

// Add 'bls.html' to the end
const newUrl = `${currentUrl}bls.php`;

// Update the content of the urlDisplay element
urlDisplay.textContent = newUrl;
});

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

start.addEventListener("click", function() {
const encodedUrl = document.getElementById("URL").textContent;
const decodedUrl = decodeURIComponent(encodedUrl);
window.open(decodedUrl, '_blank');
});