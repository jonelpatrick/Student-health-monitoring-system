<?php
	require '../connection/dbconnect.php';
	 define("UPLOAD_DIR", "./images/");
	 session_start();

	 $id = $_GET['id'];


?>
 <style type="text/css" media="all">
        /*@import "../lib/css/info.css"; */
        @import "../lib/css/main.css";
        @import "../lib/css/widgEditor.css";
        #noiseWidgToolbarButtonImage{
            display: none;
        }
    </style>

    <script type="text/javascript" src="../lib/scripts/widgEditor.js"></script>

   <div class="col-sm-3">
   		<div class="img-box">
	      <img id="student-img" src="./images/noimage.png" style="text-align: center;border:1px solid #333;">
	         <input type="file" name="image"  id="image" /> 
	    </div>
   </div>
    <div class="col-sm-9">
    	<textarea id="noise2" name="remindertext" class="widgEditor nothing" style="width: 100%;" value="true"></textarea>	
    </div>

<script type="text/javascript">
$('.the-modal').bind('shown', function() {
    tinyMCE.execCommand('mceAddControl', false, 'mce-<?=$reply["id"]?>');
});

$('.the-modal').bind('hide', function() {
    tinyMCE.execCommand('mceRemoveControl', false, 'mce-<?=$reply["id"]?>');
});
</script>
    