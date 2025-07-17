<!-- Add overlay to prevent interacting with page behind modal -->  
<div id="modalOverlay"></div>
    <!-- video background 
    <video id="video" src="https://joshcollingwood.com/virtualBLS/resources/background.mp4" autoplay muted loop></video>-->
    <!-- /video background --> 
    <!-- Terms and Conditions Modal -->
    <div id="termsModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <h2>Welcome</h2>
            <p>Thank you for taking the time to preview this tool.<br />Please send any and all feedback to Josh Collingwood at <a href="mailto:josh.collingwood@me.com">josh.collingwood@me.com</a></p>
            <p><b>Note:</b> For best results, a landscape-oriented display of at least 10.5" is recommended.</p>
            <h3>Terms and Conditions</h3>
            <p>This app is intended to be used as a therapeutic intervention in clinical mental health settings.<br /><br />By continuing, I agree that:</p>
            <ul>
                <li>I am a licensed therapist who has been through training in EMDR</li>
                <li>I acknowledge that this tool is in "beta", and as such, it is a work in progress with new features being added regularly as feedback is gathered.</li>
                <li>I understand the potential risks associated with EMDR and with beta software and accept responsibility for its use.</li>
            </ul>
            <button id="agreeBtn">I Agree</button>
            <button id="disagreeBtn">I Disagree</button>
            <br /><br />
            <p class="yearName"><span id="year"></span> Collingwood Enterprises LLC</p>
        </div>
    </div>
    <div id="startContainer">
        <h1>Virtual BLS (Beta)</h1>
        <!--<p>Currently Set To: Interactive Mode (<a href="https://joshcollingwood.com/virtualBLS/publicBeta/beta2/visual-Only/vindex.html">Switch To Visual-Only Mode</a>)</p>-->
        <h3>Create Your Session using the form below</h3>
        <h2 id="disclaimer">***For use only with a therapist present***</h2>
        <p id="bottomYearName"><span id="year2"></span> Collingwood Enterprises LLC</p>
    </div>
    <div class="form-container">
        <form id="settingsForm">
            <label for="timeoutInput">Length of BLS (in seconds):</label>
            <input type="number" id="timeout" name="timeout" required>
            <br />
            <label for="background">Background Options:</label>
            <select id="background" name="background">
                <option value="space">Outer Space</option>  
                <option value="light">Light</option>
                <option value="dark">Dark</option>
            </select>
            <br />
            <label for="target">Target Choice:</label>
            <select id="target" name="target">
                <option value="crosshairs">Crosshairs</option>
                <option value="balls">Balls</option>
                <option value="circles">Circles</option>
            </select>
            <br />
            <button id="submit" type="submit">Generate Session</button>
            <div id="URL"></div>
            <button id="copy">Copy Link to send to client</button>
            <button id="start">Start Session in a new tab</button>
            <button id="stop">Stop BLS</button>
            <p><a class="link" href="https://joshcollingwood.com/virtualBLS/membership-account/">Back to my account page</a></p>
        </form>
    </div>   