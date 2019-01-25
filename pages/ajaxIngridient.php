<?php
	require '../connection/dbconnect.php';

	//before modal show make a function that will delete all menu id = 0 before showing all ingridients.

	if(isset($_POST['action'])){

		$menu_id = $_POST['menuId'];
		$action = $_POST['action'];
		$ingridient = $_POST['ingridient'];
		$budget = $_POST['budget'];	
		$quantity = $_POST['quantity'];	
		$ingridientId = $_POST['ingridientId'];	
		$price 		  = $_POST['price'];

		if($action == 'save'){

			$sql = "INSERT into tbl_ingridients (ingridient,budget,price,quantity,menu_id)VALUES('$ingridient','$budget','$price','$quantity','$menu_id')";
			if (mysqli_query($mysqli,$sql)) {

			}else{
				echo "Something went wrong";
			}

		}else if($action == 'edit'){

			$sql = "UPDATE tbl_ingridients SET ingridient = '$ingridient', budget = '$budget',price = '$price', quantity = '$quantity' WHERE id = '$ingridientId'";
			if (mysqli_query($mysqli,$sql)) {

			}else{
				echo "Something went wrong";
			}

		}else if($action == 'delete'){

			$sql = "DELETE FROM tbl_ingridients WHERE id = '$ingridientId'";
			if (mysqli_query($mysqli,$sql)) {

			}else{
				echo "Something went wrong";
			}

		}

		if(empty($menu_id)){
			$menu_id = 0;
		}

		//get the total amount of budget
		$total_budget=0;
		$sql_amount = "SELECT SUM( budget ) total FROM  `tbl_ingridients` WHERE menu_id ='$menu_id'";
		 $result_amount = mysqli_query($mysqli,$sql_amount);
		  if (mysqli_num_rows($result_amount) > 0) {     
		  		while($row_amount = mysqli_fetch_assoc($result_amount)) {
		  			$total_budget = $row_amount['total'];
		  		}
		  }
		//select all ingridients
		$sql = "SELECT * FROM tbl_ingridients where menu_id=$menu_id";
		 $result = mysqli_query($mysqli,$sql);

          if (mysqli_num_rows($result) > 0) {                                     

          	echo ' <table width="100%" class="table table-striped table-bordered table-hover" id="listofingridients">';
          	echo '<thead>';
          	echo ' <tr>';
          	echo '<th>ID</th>';
          	echo '<th>Ingridient</th>';
          	echo '<th>Quantity</th>';
          	echo '<th>Price</th>';
          	echo '<th>Alloted Budget</th>'; 
			echo '<th>Total</th>';           	         	
          	echo ' </tr>';
          	echo '</thead>';
          	echo '<input type="hidden" value="'.$total_budget.'" id="dynamicTotalBudget">';
          	echo ' <tbody>';
              while($row = mysqli_fetch_assoc($result)) {
              	$totalxx = $row['quantity'] * $row['price'];
              	echo '<tr onclick="javascript:showRow(this);">';              
              	echo ' <td>'.$row['id'].'</td>';
              	echo ' <td>'.$row['ingridient'].'</td>';
              	echo ' <td>'.$row['quantity'].'</td>';
              	echo ' <td>&#x20B1; '.$row['price'].'</td>';
              	echo ' <td>&#x20B1; '.$row['budget'].'</td>';
              	echo ' <td>&#x20B1; '.$totalxx.'</td>';
              	echo '</tr>';

              }
            echo '</tbody>';
            echo '</table>';
          }else{
          	echo "Empty Result";
          }
	}


?>