<?php
	require '../connection/dbconnect.php';	
	

	if(isset($_GET['lId']) && isset($_GET['mId'])){

		$liquidationId = $_GET['lId'];
		$menuId = $_GET['mId'];

		$sql = "SELECT id,file_name FROM tbl_liquidation WHERE menu_id = '$menuId'";

		$result = mysqli_query($mysqli,$sql);
        if (mysqli_num_rows($result) > 0) {	                                    
        	echo "<table>";

            while($row = mysqli_fetch_assoc($result)) {
            	
            	echo "<tr>";
            	echo '<td><i class="fa fa-file"></i> '.$row['file_name'].'<input id="file'.$row['id'].'" type="hidden" value="'.$row['file_name'].'"></td>';
            	echo '<td><a style="margin-left:2em;" href="downloadfiles.php?file='.$row['file_name'].'"><i class="fa fa-download"></i> Download | </a><br/></td>';
            	echo '<td ><span class="spanLink" onclick="removefiles('.$row['id'].','.$liquidationId.','.$menuId.')" ><i class="fa fa-close"></i> Remove </span></td>';
            	
            	echo "</tr>";
            	

            }
            echo "</table><br>";
        }

	}else{

		echo "<i>No file  attach</i><br>";
	}
	
	
?>