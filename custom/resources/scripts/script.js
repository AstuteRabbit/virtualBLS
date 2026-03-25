//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

//Some variables
var button = document.getElementById('myButton');
var targets = document.getElementById('targets');
var instructions = document.getElementById('instructions');
var disclaimer = document.getElementById('disclaimer');
var textInput = document.getElementById('timeoutInput')
const urlParams = new URLSearchParams(window.location.search);
const timeoutFromUrl = urlParams.get('timeout');

// Audio context for generating sounds
var audioContext = new (window.AudioContext || window.webkitAudioContext)();

// Function to play a tone with stereo panning
function playTone(pan) {
    // Create oscillator (sound generator)
    var oscillator = audioContext.createOscillator();
    oscillator.type = 'sine'; // sine wave (smooth tone)
    oscillator.frequency.setValueAtTime(440, audioContext.currentTime); // 440 Hz (A4 note)
    
    // Create stereo panner
    var panner = audioContext.createStereoPanner();
    panner.pan.setValueAtTime(pan, audioContext.currentTime); // -1 = left, 1 = right
    
    // Create gain node for volume control
    var gainNode = audioContext.createGain();
    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime); // 30% volume
    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2); // fade out
    
    // Connect: oscillator -> panner -> gain -> speakers
    oscillator.connect(panner);
    panner.connect(gainNode);
    gainNode.connect(audioContext.destination);
    
    // Play the sound
    oscillator.start(audioContext.currentTime);
    oscillator.stop(audioContext.currentTime + 0.2); // stop after 0.2 seconds
}

// Score counter setup
var counter = 0;
var counterDiv = document.getElementById('counter');
if (!counterDiv) {
    counterDiv = document.createElement('div');
    counterDiv.id = 'counter';
    counterDiv.style.position = 'fixed';
    counterDiv.style.top = '20px';
    counterDiv.style.left = '50%';
    counterDiv.style.transform = 'translateX(-50%)';
    counterDiv.style.fontSize = '2em';
    counterDiv.style.fontWeight = 'bold';
    counterDiv.style.zIndex = '1000';
    counterDiv.style.background = 'rgba(255,255,255,0.8)';
    counterDiv.style.padding = '8px 24px';
    counterDiv.style.borderRadius = '12px';
    counterDiv.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
    counterDiv.style.display = 'none';
    document.body.appendChild(counterDiv);
}

// Set the timeout duration from the URL parameters
//if (timeoutFromUrl) {
//    document.getElementById('timeoutInput').value = timeoutFromUrl;
//}

// Set the timeout duration from the URL parameter
//const timeoutInput = document.getElementById('timeoutInput');

//timeoutInput.addEventListener('input', function() {
//    const newUrl = new URL(window.location.href);
//    newUrl.searchParams.set('timeout', timeoutInput.value);
//    window.history.replaceState(null, null, newUrl.toString());
//});

// Transition from the start button to the BLS interface
button.addEventListener('click', function() {
    targets.style.display = 'block';
    button.style.display = 'none';
    instructions.style.display = 'none';
    disclaimer.style.display = 'none';
    textInput.style.display = "none";

    // Reset and show counter
    counter = 0;
    counterDiv.textContent = "Targets: 0";
    counterDiv.style.display = 'block';

    // Set a time limit for the BLS
    const time = timeoutInput.value; //The timeout value
    setTimeout(function() {
        targets.style.display = 'none';
        button.style.display = 'block';
        counterDiv.style.display = 'none'; // Hide counter at end
        alert("Round complete! Take a deep breath. Check in with your therapist.");
    }, time * 1000); // convert seconds to milliseconds
});


// Behavior of the target elements
function target1click() {
    var target1 = document.getElementById("target1");
    var target2 = document.getElementById("target2");

    var top = Math.floor(Math.random() * (window.innerHeight - 200)); // generate a random y-coordinate value while ensuring that the target stays fully visible within the viewport
    target1.style.display = "none"; // hide the clicked element
    target1.style.top = top + "px"; // move the hidden element to the random y-coordinate value
    target2.style.display = "block"; //display the other element

    // Play sound panned to the left
    playTone(-1);

    // Increment counter
    counter++;
    counterDiv.textContent = "Targets: " + counter;
}
function target2click() {
    var target1 = document.getElementById("target1");
    var target2 = document.getElementById("target2");

    var top = Math.floor(Math.random() * (window.innerHeight - 200)); // generate a random y-coordinate value while ensuring that the target stays fully visible within the viewport
    target2.style.display = "none"; // hide the clicked element
    target2.style.top = top + "px"; // move the hidden element to the random y-coordinate value
    target1.style.display = "block"; // display the other element

    // Play sound panned to the right
    playTone(1);

    // Increment counter
    counter++;
    counterDiv.textContent = "Targets: " + counter;
}
