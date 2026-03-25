<!--
This file is part of Virtual BLS.
Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>
-->
<!-- video backgrounds -->
<video id="space" src="https://virtualbls.net/wp-content/custom/resources/background.mp4" autoplay muted loop></video>
<video id="asteroids" src="https://virtualbls.net/wp-content/custom/resources/asteroids.mp4" autoplay muted loop></video>

        <!-- /video background -->
        <!-- Instructions for the client -->
        <div id="startContainer">
            <h1 id="instructions">Focus on your level of distress and tap/click on the targets as they appear</h1>
            <button id="myButton">Start</button>
            <h2 id="disclaimer">***For use only with a therapist present***</h2>
            <p id="bottomYearName">&copy; <span id="year2"></span> Collingwood Enterprises LLC</p>
        </div>
        <!-- /Instructions -->
        <input type="text" placeholder="Length of BLS in seconds" id="timeoutInput" style="display:none;">
        <!-- The target elements -->
        <div id="targets" style="display: none;">      
            <div id="target1" onclick="target1click()">
                <img class="target" alt="target" src="https://virtualbls.net/wp-content/custom/resources/targets/target.png" />
            </div>
            <div id="target2" onclick="target2click()" style="display:none;">
                <img class="target" alt="target" src="https://virtualbls.net/wp-content/custom/resources/targets/target.png" />
            </div> 
        </div>
        <!-- /Target Elements -->