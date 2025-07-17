

    //Some variables
    var button = document.getElementById('myButton');
    var targets = document.getElementById('targets');
    var instructions = document.getElementById('instructions');
    var disclaimer = document.getElementById('disclaimer');
    var textInput = document.getElementById('timeoutInput')
    const urlParams = new URLSearchParams(window.location.search);
    const timeoutFromUrl = urlParams.get('timeout');
      

    // Set the timeout duration from the URL parameter
    if (timeoutFromUrl) {
    document.getElementById('timeoutInput').value = timeoutFromUrl;
    }
    
    // Set the timeout duration from the URL parameter
    const timeoutInput = document.getElementById('timeoutInput');
    
    timeoutInput.addEventListener('input', function() {
    const newUrl = new URL(window.location.href);
    newUrl.searchParams.set('timeout', timeoutInput.value);
    window.history.replaceState(null, null, newUrl.toString());
    });

    // Transition from the instructions to the BLS activity
    button.addEventListener('click', function() {
      targets.style.display = 'block';
      button.style.display = 'none';
      instructions.style.display = 'none';
      disclaimer.style.display = 'none';
      textInput.style.display = "none";

    // Set a time limit for the BLS
    const time = timeoutInput.value;//The timeout value
    setTimeout(function() {
      targets.style.display = 'none';
      button.style.display = 'block';
      alert("Round complete! Take a deep breath. Check in with your therapist.");
    }, time * 1000); // convert seconds to milliseconds


    });
    // End Transition
    
    // Behavior of the target elements
    function target1click() {
            var target1 = document.getElementById("target1");
            var target2 = document.getElementById("target2");
            
            var top = Math.floor(Math.random() * (window.innerHeight - 200)); // generate a random y-coordinate value
            target1.style.display = "none"; // hide the clicked element
            target1.style.top = top + "px"; // move the hidden element to the random y-coordinate value
            target2.style.display = "block"; //display the other element
        }
    function target2click() {
            var target1 = document.getElementById("target1");
            var target2 = document.getElementById("target2");
    
            var top = Math.floor(Math.random() * (window.innerHeight - 200)); // generate a random y-coordinate value 
            target2.style.display = "none"; // hide the clicked element
            target2.style.top = top + "px"; // move the hidden element to the random y-coordinate value
            target1.style.display = "block"; // display the other element
        }
    //End target element behavior
      