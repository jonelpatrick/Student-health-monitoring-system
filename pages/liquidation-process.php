<?php
	require '../connection/dbconnect.php';

$liquidationId = $_POST['liquidationId'];

if(isset($_POST['submit'])){

		$total_expenses = 0;
		$menu_id = $_POST['menuId'];
		$num_rows = $_POST['ingridients_num_rows'];

		for($i = 0; $i < $num_rows;){
			$i++;
			$ingridient[$i] = $_POST['ingridientLiquidation'][$i];
			$ingridientId[$i] = $_POST['ingridientId'][$i];	
			$total_expenses += $ingridient[$i];

			$sql = "UPDATE tbl_ingridients SET liquidation = '$ingridient[$i]' WHERE id = $ingridientId[$i]";
		    if (!mysqli_query($mysqli,$sql)) {

		    	echo "something went wrong";
		    	exit(0);
		    }else{
		    	header('Location: menulist.php');
		    }
		}

		if(empty($liquidationId) || !empty($_FILES['uploadLiquidationFile'])){

			//$files = array_filter($_FILES['upload']['name']); something like that to be used before processing files.
			// Count # of uploaded files in array
			$total = count($_FILES['uploadLiquidationFile']['name']);

			// Loop through each file
			for($i=0; $i<$total; $i++) {
				  //Get the temp file path
				  $tmpFilePath = $_FILES['uploadLiquidationFile']['tmp_name'][$i];

				  //Make sure we have a filepath
				  if ($tmpFilePath != ""){
					    //Setup our new file path
					    $newFilePath = "../upload/" . $_FILES['uploadLiquidationFile']['name'][$i];

					    $file_name = $_FILES['uploadLiquidationFile']['name'][$i];
					    //Upload the file into the temp dir
					    if(!move_uploaded_file($tmpFilePath, $newFilePath)) {

					      echo "filename already exists";

					    }
					    //insert data here
					    $sql = "INSERT INTO tbl_liquidation (menu_id,total_expenses,file_name) VALUES ('$menu_id','$total_expenses','$file_name')";
					   
					    if (mysqli_query($mysqli,$sql)) {

					    	header('Location: menulist.php');
					    	
					     }else{

					    	echo "something went wrong";
					    	exit(0);
					    }
					}
				}

		}else{
			
			$sql = "UPDATE tbl_liquidation SET total_expenses = '$total_expenses' WHERE menu_id = '$menu_id'";
			 if (mysqli_query($mysqli,$sql)) {

		    	header('Location: menulist.php');

		    }else{

		    	echo "something went wrong";
		    	exit(0);
		    }
		}

}

?>