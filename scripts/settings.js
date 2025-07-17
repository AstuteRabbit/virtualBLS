

const form = document.getElementById('settingsForm');
const urlDisplay = document.getElementById('URL');

const copy = document.getElementById("copy");
const start = document.getElementById("start");

form.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the default form submission
copy.style.display = 'block';
start.style.display = 'block';
  // Get the form values
  const timeout = document.getElementById('timeout').value;
  const background = document.getElementById('background').value;
  const target = document.getElementById('target').value;


  // Construct the URL with query parameters
  const baseUrl = "file:///Users/josh/Documents/Code/Bilateral%20Elements/Public%20Beta/bls.html";
  const queryParams = new URLSearchParams({
    timeout: encodeURIComponent(timeout),
    background: encodeURIComponent(background),
    target: encodeURIComponent(target),
  });
  const url = `${baseUrl}?${queryParams.toString()}`;

  // Update the content of the urlDisplay element with the generated URL
  urlDisplay.textContent = `${url}`; 
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

  window.location.href = decodedUrl;
});
