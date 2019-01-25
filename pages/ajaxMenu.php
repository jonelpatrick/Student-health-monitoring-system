<?php
	require '../connection/dbconnect.php';
	session_start();

	if(isset($_POST['action'])){

		$action 		= $_POST['action'];
		$menuName 		= $_POST['menuName'];
		$assignParent 	= $_POST['assignParent'];
		$totalBudget 	= $_POST['totalBudget'];
		$chosenDate 	= $_POST['chosenDate'];
		$menu_id 		= $_POST['menuId'];
		$alloted_budget = $_POST['alloted_budget'];
	   	
   		$prepare_by 	= $_SESSION['login_id'];   		    

		if($action == 'save'){	

			$sql = "INSERT into tbl_menu (menu,alloted_budget,total_budget,parent_id,date_chosen,prepared_by_id)VALUES('$menuName','$alloted_budget','$totalBudget','$assignParent','$chosenDate','$prepare_by')";

			if (mysqli_query($mysqli,$sql)) {

				$sql_getId = "SELECT id FROM tbl_menu WHERE date_chosen = '$chosenDate'";

				$result = mysqli_query($mysqli,$sql_getId);

				if (mysqli_num_rows($result) > 0) {     

				  		while($row = mysqli_fetch_assoc($result)) {

				  			$menu_idl = $row['id'];
				  			$sql_ingridients = "UPDATE tbl_ingridients SET menu_id = '$menu_idl' WHERE menu_id = 0";
				  			if (mysqli_query($mysqli,$sql_ingridients)) {

							}else{
								echo "Something went wrong";
							}
			
				  		}
				  }
				//$sql_ingridients = "Update tbl_ingridients SET menu_id"

			}else{
				echo "Something went wrong";
			}

		}else if($action == 'update'){
			$sql = "UPDATE tbl_menu SET menu = '$menuName',alloted_budget = '$alloted_budget' ,total_budget = '$totalBudget', parent_id = '$assignParent',prepared_by_id = '$prepare_by' WHERE id = '$menu_id'";
			if (!mysqli_query($mysqli,$sql)) {
				echo "Something went wrong";
			}

		}else if($action == 'delete'){

			$sql = "DELETE FROM tbl_menu WHERE id='$menu_id'";

			if (mysqli_query($mysqli,$sql)) {

				$sql_ingridients = "DELETE FROM tbl_ingridients WHERE menu_id = '$menu_id'";
				mysqli_query($mysqli,$sql_ingridients);

			}else{
				
				echo "Something went wrong";
			}
		}
	}
?>