<?php
	require '../connection/dbconnect.php';
   

	if(isset($_POST['type'])){
		$type =$_POST['type'];
		$resultbmi=$_POST['resultbmi'];
		$resultclassify = $_POST['resultclassify'];
		$weight=$_POST['weight'];
		$height =$_POST['height'];
		$currentdate=date("Y-m-d");
		$healthId=$_POST['healthId'];
    $studentid = $_POST['studentid'];

		if($type == 'save'){
			//echo  $type." ". $bmiheight." ".$bmiweight. " ".$enteredheight." ".$enteredweight;	

			$sql ="INSERT INTO tbl_health_profile (date_check_up,weight,height,bmi,classification,student_id)VALUES('$currentdate','$weight','$height','$resultbmi','$resultclassify','$studentid')";
			if (mysqli_query($mysqli,$sql)) {
				echo  '<table width="100%" class="table table-striped table-bordered table-hover" >';
                echo '<thead>';
                echo  '<tr>';
                echo '<th>ID</th>';   
	            echo '<th>Date</th>';
              	echo '<th>weight</th>';
               	echo '<th>height</th>';
                echo '<th>BMI</th>';
                echo '<th>Class</th>'; 
                echo '</tr>';    
                echo '</thead>';  
                echo ' <tbody>';           
                                  
                $sql = "SELECT * FROM tbl_health_profile WHERE student_id='$studentid' ORDER BY id desc";
                $result = mysqli_query($mysqli,$sql);

                if (mysqli_num_rows($result) > 0) {                                     

                    while($row = mysqli_fetch_assoc($result)) {
                     echo '<tr onclick="javascript:showRow2(this);">';
                      echo '<td>'.$row['id'].'</td>';
                      echo '<td>'.$row['date_check_up'].'</td>';
                      echo '<td>'.$row['weight'].'</td>';
                      echo '<td>'.$row['height'].'</td>';
                      echo '<td>'.$row['bmi'].'</td>';
                      echo '<td>'.$row['classification'].'</td>';
                      echo '</tr>';
                    }
                  }
                echo '</tbody>';                        
                echo '</table>';
                                     
			}

		}else if($type == 'edit'){
			
			$sql ="UPDATE tbl_health_profile SET weight='$weight',height='$height',bmi='$resultbmi',classification='$resultclassify' WHERE id='$healthId' ";
			if (mysqli_query($mysqli,$sql)) {
				echo  '<table width="100%" class="table table-striped table-bordered table-hover" >';
                echo '<thead>';
                echo  '<tr>';
                echo '<th>ID</th>';   
	            echo '<th>Date</th>';
              	echo '<th>weight</th>';
               	echo '<th>height</th>';
                echo '<th>BMI</th>';
                echo '<th>Class</th>'; 
                echo '</tr>';    
                echo '</thead>';  
                echo ' <tbody>';           
                                  
                $sql = "SELECT * FROM tbl_health_profile WHERE student_id='$studentid' ORDER BY id desc";
                $result = mysqli_query($mysqli,$sql);

                if (mysqli_num_rows($result) > 0) {                                     

                    while($row = mysqli_fetch_assoc($result)) {
                     echo '<tr onclick="javascript:showRow2(this);">';
                      echo '<td>'.$row['id'].'</td>';
                      echo '<td>'.$row['date_check_up'].'</td>';
                      echo '<td>'.$row['weight'].'</td>';
                      echo '<td>'.$row['height'].'</td>';
                      echo '<td>'.$row['bmi'].'</td>';
                      echo '<td>'.$row['classification'].'</td>';
                      echo '</tr>';
                    }
                  }
                echo '</tbody>';                        
                echo '</table>';
                                     
			}
		}
	}
  if(isset($_POST['select'])){
    $studentidl =$_POST['studentid'];

            echo  '<table width="100%" class="table table-striped table-bordered table-hover" >';
            echo '<thead>';
            echo  '<tr>';
            echo '<th>ID</th>';   
            echo '<th>Date</th>';
            echo '<th>weight</th>';
            echo '<th>height</th>';
            echo '<th>BMI</th>';
            echo '<th>Class</th>'; 
            echo '</tr>';    
            echo '</thead>';  
            echo ' <tbody>';           
                              
            $sql = "SELECT * FROM tbl_health_profile WHERE student_id='$studentidl' ORDER BY id desc";
            $result = mysqli_query($mysqli,$sql);

            if (mysqli_num_rows($result) > 0) {                                     

                while($row = mysqli_fetch_assoc($result)) {
                  echo '<tr onclick="javascript:showRow2(this);">';
                  echo '<td>'.$row['id'].'</td>';
                  echo '<td>'.$row['date_check_up'].'</td>';
                  echo '<td>'.$row['weight'].'</td>';
                  echo '<td>'.$row['height'].'</td>';
                  echo '<td>'.$row['bmi'].'</td>';
                  echo '<td>'.$row['classification'].'</td>';
                  echo '</tr>';
                }
              }
            echo '</tbody>';                        
            echo '</table>';
  }
	
?>
