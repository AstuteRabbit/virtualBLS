let settings = {};

    function changeBackgroundColor(background) {
        const body = document.querySelector('body');
        const video = document.getElementById("video");

        switch(background) {
            case 'light':
                video.style.display = "none";
                body.style.backgroundColor = 'rgb(201, 198, 198)';
                body.style.color = 'black';
                break;
            case 'dark':
                video.style.display = "none";
                body.style.backgroundColor = 'rgb(62, 62, 62)';
                break;
            case 'space':
                body.style.backgroundColor = 'black';
                video.style.display = "block";
                break;
            default:
                body.style.backgroundColor = 'initial';
                video.style.display = "block";
        }
    }

    function updateTargetImages(target) {
        const targetElements = document.querySelectorAll('.target');
        targetElements.forEach(targetElement => {
            switch(target) {
                case 'balls':
                    targetElement.src = 'https://joshcollingwood.com/virtualBLS/resources/targets/ball.png';
                    break;
                case 'circles':
                    targetElement.src = 'https://joshcollingwood.com/virtualBLS/resources/targets/circle.png';
                    break;
                case 'crosshairs':
                    targetElement.src = 'https://joshcollingwood.com/virtualBLS/resources/targets/target.png';
                    break;
                default:
                    targetElement.src = 'https://joshcollingwood.com/virtualBLS/resources/targetsresources/target.png';
            }
        });
    }

    function applySettings() {
    if (settings.refresh) {
        console.log('Refresh flag detected, reloading page in 1 second...');
        setTimeout(function() {
            location.reload();
        }, 1000);
    } 

        // Apply background setting
        changeBackgroundColor(settings.background);
        console.log('Background color changed to:', settings.background);
        // Apply target setting
        updateTargetImages(settings.target);
        console.log('Target updated to:', settings.target);
        // Apply timeout setting
        if (settings.timeout) {
            document.getElementById('timeoutInput').value = settings.timeout;
        }

        console.log('Settings applied:', settings);
        
}

function fetchSettings() {
    $.ajax({
        url: './get-settings.php',
        method: 'GET',
        success: function(response) {
            settings = JSON.parse(response);
            console.log('Fetched settings:', settings);
            applySettings();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching settings:', error);
        }
    });
}

    // Fetch settings every 1 second
    setInterval(fetchSettings, 1000);


    $(document).ready(function(){
        fetchSettings();
        document.getElementById("year").innerHTML = new Date().getFullYear();
        document.getElementById("year2").innerHTML = new Date().getFullYear();    
    });