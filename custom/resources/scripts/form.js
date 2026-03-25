//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

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
    // Get current URL and remove 'settings.html' if present
const currentUrl = window.location.href.replace('settings.php', '');

// Add an expiration parameter for 2 hours
const expires = Math.floor(Date.now() / 1000) + (2 * 60 * 60); 


// Add 'bls.php' to the end
const newUrl = `${currentUrl}bls.php?expires=${expires}`;

// Update the content of urlDisplay element
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

//<!--   Target modal logic -->

    //   Modal elements (overlay var renamed to avoid duplication)
    const targetModal = document.getElementById('targetModal');
    const targetOverlay = document.getElementById('modalOverlay'); 
    const targetSearch = document.getElementById('targetSearch');
    const targetList = document.getElementById('targetList');
    const targetHidden = document.getElementById('target');
    const targetDisplay = document.getElementById('targetDisplay');
    const targetClose = document.getElementById('targetClose');
 
    //   Large list of targets with PNG icons
    const targetOptions = [
      { value: 'crosshairs', label: 'Crosshairs (Default)', icon: '../../../custom/resources/targets/target.png' }, 
      { value: 'balls', label: 'Balls', icon: '../../../custom/resources/targets/ball.png' },
      { value: 'circles', label: 'Circles', icon: '../../../custom/resources/targets/circle.png' }, 
      { value: 'aliens', label: 'Aliens', icon: '../../../custom/resources/targets/alien.png' },//delete this immediately in the event of alien contact
      { value: 'biohazard', label: 'Biohazard Signs', icon: '../../../custom/resources/targets/biohazard.png' },
      { value: 'diamonds', label: 'Diamonds', icon: '../../../custom/resources/targets/diamond.png' },
      { value: 'spider', label: 'Spiders', icon: '../../../custom/resources/targets/spider.png' },
      { value: 'star', label: 'Stars', icon: '../../../custom/resources/targets/star.png' },
  
      // CHANGE THE LINKS FOR THE IMAGES TO THE CORRECT ONES

 
      
    ];

    //   Open/close functions (null-safe for search)
    function openTargetModal() {
      targetModal.style.display = 'block';
      targetOverlay.style.display = 'block';
      renderTargetList(targetSearch ? targetSearch.value : '');
      if (targetSearch) targetSearch.focus();
    }
    function closeTargetModal() {
      targetModal.style.display = 'none';
      targetOverlay.style.display = 'none'; 
    }

  
    //   Render filtered list with icons
    function renderTargetList(query = '') {
      const q = (query || '').toLowerCase();
      targetList.innerHTML = '';
      targetOptions
        .filter(o => o.label.toLowerCase().includes(q) || o.value.toLowerCase().includes(q))
        .forEach(o => {
          const item = document.createElement('button');
          item.className = 'target-item';
          item.type = 'button';
          item.setAttribute('role', 'button');
          item.tabIndex = 0;

          if (o.icon) {
            const img = document.createElement('img'); //   PNG icon
            img.src = o.icon;
            img.alt = `${o.label} icon`;
            img.className = 'target-icon';
            img.loading = 'lazy';
            item.appendChild(img);
          }

          const text = document.createElement('span');
          text.className = 'target-label';
          text.textContent = o.label;
          item.appendChild(text);

          item.addEventListener('click', () => {
            targetHidden.value = o.value;
            targetDisplay.value = o.label;
            targetHidden.dispatchEvent(new Event('change', { bubbles: true }));// Trigger change for form submissions
            closeTargetModal();
          });
          item.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') item.click();
          });

          targetList.appendChild(item);
        });
    }

    //   Wire up events
    targetDisplay.addEventListener('click', openTargetModal);
    targetClose.addEventListener('click', closeTargetModal);
    targetOverlay.addEventListener('click', closeTargetModal);
    targetSearch.addEventListener('input', () => renderTargetList(targetSearch.value));
