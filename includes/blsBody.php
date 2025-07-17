<!-- video background -->
<video id="video" src="https://joshcollingwood.com/virtualBLS/resources/background.mp4" autoplay muted loop></video>
        <!-- /video background -->
        <!-- Instructions for the client -->
        <div id="startContainer">
            <h1 id="instructions">Focus on your level of distress and tap/click on the targets as they appear</h1>
            <button id="myButton">Start</button>
            <h2 id="disclaimer">***For use only with a therapist present***</h2>
            <p id="bottomYearName"><span id="year2"></span> Collingwood Enterprises LLC</p>
        </div>
        <!-- /Instructions -->
        <input type="text" placeholder="Length of BLS in seconds" id="timeoutInput" style="display:none;">
        <!-- The target elements -->
        <div id="targets" style="display: none;">      
            <div id="target1" onclick="target1click()">
                <img class="target" alt="target" src="" />
            </div>
            <div id="target2" onclick="target2click()" style="display:none;">
                <img class="target" alt="target" src="" />
            </div>
        </div>
        <!-- /Target Elements-->