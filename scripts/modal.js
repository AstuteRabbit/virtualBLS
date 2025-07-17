
// Get the modal overlay
const modalOverlay = document.getElementById("modalOverlay");

// Terms and Conditions Modal
// Get modal and button
const modal = document.getElementById("termsModal");
const agreeBtn = document.getElementById("agreeBtn");

// When button clicked, close modal
agreeBtn.onclick = function() {
modal.style.display = "none";
modalOverlay.style.display = "none";
}

disagreeBtn.onclick = function() {
alert("You must agree to the terms and conditions below in order to use this software");
}

// Show modal on page load
window.onload = function() {
modal.style.display = "block";
modalOverlay.style.display = "block"; 
}
// End Terms and Conditions Modal
