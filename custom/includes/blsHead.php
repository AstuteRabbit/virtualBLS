<!--
This file is part of Virtual BLS.
Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>
-->
<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Virtual BLS</title>
        <meta charset="utf-8" />
        <script src="https://virtualbls.net/wp-content/custom/resources/scripts/jquery-3.7.1.min.js"></script> 
        <!-- Make it live nicely on your home screen -->
        <!-- Specify an icon later <link rel="shortcut icon" sizes="196x196" href="./favicon.png"> -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Virtual BLS">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <!-- /Home screen stuff -->
        <link rel="stylesheet" type="text/css" href="https://virtualbls.net/wp-content/custom/resources/scripts/style.css" />
        <!-- Ad-blocker warning script -->
        <div id="adsbox" style="width:1px;height:1px;position:absolute;left:-9999px">ad</div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
                function isAdBlocked() {
                const el = document.getElementById('adsbox');
                if (!el) return true; // removed by blocker
                const style = window.getComputedStyle(el);
                return style.display === 'none' || style.visibility === 'hidden';
                }
                if (isAdBlocked()) {
                window.alert('For best results, please disable your ad-blocker for this site.');
                } else {
                const el = document.getElementById('adsbox');
                if (el) el.remove();
                }
        });
        </script>
        <!-- /Ad-blocker warning script -->