//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

let settings = {};

    function changeBackgroundColor(background) {
        const body = document.querySelector('body');
        const space = document.getElementById("space");
        const asteroids = document.getElementById("asteroids");

        switch(background) {
            case 'light':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(201, 198, 198)';
                body.style.color = 'black';
                break;
            case 'dark':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(62, 62, 62)';
                break;
            case 'space':
                body.style.backgroundColor = 'black';
                space.style.display = "block";
                asteroids.style.display = "none";
                break;
            case 'asteroids':
                body.style.backgroundColor = 'black';
                space.style.display = "none";
                asteroids.style.display = "block";
                break;
            case 'blue':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(83, 151, 207)';
                document.querySelector('#bottomYearName').style.setProperty('color', 'white', 'important'); 
                break;
            case 'purple':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(140, 40, 120)';
                document.querySelector('#bottomYearName').style.setProperty('color', 'white', 'important'); 
                break;
            case 'red':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(230, 81, 81)';
                document.querySelector('#bottomYearName').style.setProperty('color', 'white', 'important'); 
                break;
            case 'green':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(0, 128, 0)';
                document.querySelector('#bottomYearName').style.setProperty('color', 'white', 'important'); 
                break;
            case 'yellow':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(255, 255, 0)';
                body.style.setProperty('color', 'black', 'important');
                document.querySelector('#startContainer').style.setProperty('color', 'black', 'important'); 
                break;
            case 'cyan':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgba(0, 255, 255, 0.82)';
                document.querySelector('#startContainer').style.setProperty('color', 'black', 'important');
                break;
            case 'pink':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(255, 192, 203)';
                body.style.setProperty('color', 'black', 'important');
                document.querySelector('#startContainer').style.setProperty('color', 'black', 'important');
                break;
            case 'orange':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(255, 165, 0)';
                body.style.setProperty('color', 'black', 'important');
                document.querySelector('#startContainer').style.setProperty('color', 'black', 'important');
                break;
            case 'brown':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(165, 42, 42)';
                body.style.setProperty('color', 'black', 'important');
                document.querySelector('#startContainer').style.setProperty('color', 'black', 'important');
                document.querySelector('#bottomYearName').style.setProperty('color', 'white', 'important'); 
                break;
            case 'gray':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(128, 128, 128)';
                document.querySelector('#bottomYearName').style.setProperty('color', 'white', 'important'); 
                break;
            case 'white':
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(255, 255, 255)';
                body.style.setProperty('color', 'black', 'important');
                document.querySelector('#startContainer').style.setProperty('color', 'black', 'important');
                break;
            case 'black': 
                space.style.display = "none";
                asteroids.style.display = "none";
                body.style.backgroundColor = 'rgb(0, 0, 0)';
                break; 
            default:
                body.style.backgroundColor = 'initial';
                space.style.display = "block";
                asteroids.style.display = "block";
        }
    }

    function updateTargetImages(target) {
        const targetElements = document.querySelectorAll('.target');
        targetElements.forEach(targetElement => {
            switch(target) {
                case 'balls':
                    targetElement.src = '../../../custom/resources/targets/ball.png'; 
                    break;
                case 'circles':
                    targetElement.src = '../../../custom/resources/targets/circle.png';
                    break;
                case 'crosshairs':
                    targetElement.src = '../../../custom/resources/targets/target.png';
                    break;
                case 'aliens': //delete in case of alien contact so we don't offend them
                    targetElement.src = '../../../custom/resources/targets/alien.png';
                    break;
                case 'biohazard':
                    targetElement.src = '../../../custom/resources/targets/biohazard.png'; 
                    break;
                case 'diamonds':
                    targetElement.src = '../../../custom/resources/targets/diamond.png';
                    break;
                case 'spider':
                    targetElement.src = '../../../custom/resources/targets/spider.png';
                    break;
                case 'star':
                    targetElement.src = '../../../custom/resources/targets/star.png';
                    break;
                default:
                    targetElement.src = '../../../custom/resources/targets/target.png';
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

        // Apply background settings
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

    // Fetch settings every 1 second.
    setInterval(fetchSettings, 1000);


    $(document).ready(function(){
        fetchSettings();
        document.getElementById("year").innerHTML = new Date().getFullYear();
        document.getElementById("year2").innerHTML = new Date().getFullYear();    
    });