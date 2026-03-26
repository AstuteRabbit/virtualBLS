<!--
This file is part of Virtual BLS.
Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>
-->
<!-- Is the modal overlay neccesary without the T&C Modal? -->  
<div id="modalOverlay"></div>
  
    
    <div id="startContainer">
        <h1>Virtual BLS (Beta)</h1>
        <h3>Create Your Session using the form below</h3>
        <h2 id="disclaimer">***For use only with a therapist present***</h2>
        <p id="bottomYearName">&copy; <span id="year2"></span> Collingwood Enterprises LLC. Licensed under AGPLv3. [<a href="https://github.com/AstuteRabbit/virtualBLS">GitHub</a>]</p>
    </div>
    <div class="form-container">
        <form id="settingsForm">
            <label for="timeoutInput">Length of BLS (in seconds):</label>
            <input type="number" id="timeout" name="timeout" required>
            <br />
            <label for="background">Background Options:</label>
            <select id="background" name="background">
                <option value="asteroids">Asteroids</option>
                <option value="space">Outer Space</option> 
                <hr /> 
                <option value="light">Light</option>
                <option value="dark">Dark</option>
                <hr />
                <!--
                Add at a later date
                <option value="nature">Nature</option>
                <option value="ocean">Ocean</option>
                <option value="city">City</option>
                -->
                <option value="blue">Blue</option>
                <option value="purple">Purple</option>
                <option value="red">Red</option>
                <option value="green">Green</option>
                <option value="yellow">Yellow</option>
                <option value="cyan">Cyan</option>
                <option value="pink">Pink</option>
                <option value="orange">Orange</option>
                <option value="brown">Brown</option>
                <option value="gray">Gray</option>
                <option value="white">White</option>
                <option value="black">Black</option>

                
                
            </select>
            <br />
            <label for="target">Target Choice:</label>
            <!-- Read-only display + hidden value; click display to open the modal -->
            <input id="targetDisplay" type="text" readonly value="Crosshairs (Default)">
            <input id="target" name="target" type="hidden" value="crosshairs">
            <br />
            <button id="submit" type="submit">Generate Session</button>
            <div id="URL"></div>
            <button id="copy">Copy Link to Send to Client</button>
            <button id="start">Start Session in a New Tab</button>
            <button id="stop">Stop BLS</button>
            <p><a class="link" href="https://virtualbls.net/membership-account/">Back to my account page</a></p>
        </form>
    </div> 
    <!--Target chooser modal -->
    <div id="targetModal" class="modal" aria-hidden="true">
      <div class="modal-content">
        <h2>Select Target</h2>
        <!-- Search input for filtering -->
        <input type="text" id="targetSearch" placeholder="Search targets..." />
        <div id="targetList"></div>
        <button id="targetClose" type="button">Close</button>
      </div>
    </div>  