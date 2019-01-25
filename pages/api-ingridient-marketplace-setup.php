<?php 
 require '../connection/dbconnect.php';

 if(isset($_POST['addToMarket'])){

 	$name = $_POST['ing_name'];
 	$brand = $_POST['brand_name'];
 	$price = $_POST['price'];
 	$unit  = $_POST['unit'];
 	$category = $_POST['category'];
 	$section = $_POST['optionsRadioSection'];
 	$dateModified = date("Y-m-d"); 

 	switch ($section) {
 		case 0:
 			$section = 'Meat';
 			break;
 		
 		case 1:
 			$section = 'Seafoods';
 			break;

 		case 2:
 			$section = 'Vegetables';
 			break;

 		case 3:
 			$section = 'Fruits';
 			break;

 		case 4:
 			$section = 'Spices';
 			break;

 		case 5:
 			$section = 'Others';
 			break;
 		
 		default:
 			$section = 'Error';
 			break;
 	}

//echo $dateModified;

 	$sql = "INSERT INTO marketplace (name,ing_brand,price,in_unit,ing_section,ing_category,date_modified)
 			VALUES ('$name','$brand','$price','$unit','$section','$category','$dateModified')";

	if (mysqli_query($mysqli,$sql)) {	
	

	} else {
		echo "Something went wrong";
	    exit();
	}

	header("location: ingridient-marketplace-setup.php?msg=success");
		

 }else if(isset($_POST['submitDelete'])){

 	$id  = $_POST['marketIngId'];

 	$sql = "DELETE FROM marketplace WHERE id = '$id'";

 	if (mysqli_query($mysqli,$sql)) {	
	

	} else {
		echo "Something went wrong";
	    exit();
	}

	header("location: ingridient-marketplace-setup.php?msg=success");

 	

 }else if(isset($_POST['submitUpdate'])){

 	$name = $_POST['ing_name'];
 	$brand = $_POST['brand_name'];
 	$price = $_POST['price'];
 	$unit  = $_POST['unit'];
 	$category = $_POST['category'];
 	$section = $_POST['optionsRadioSection'];
 	$dateModified = date("Y-m-d"); 
 	$id  = $_POST['marketIngId'];

 	switch ($section) {
 		case 0:
 			$section = 'Meat';
 			break;
 		
 		case 1:
 			$section = 'Seafoods';
 			break;

 		case 2:
 			$section = 'Vegetables';
 			break;

 		case 3:
 			$section = 'Fruits';
 			break;

 		case 4:
 			$section = 'Spices';
 			break;

 		case 5:
 			$section = 'Others';
 			break;
 		
 		default:
 			$section = 'Error';
 			break;
 	}

 	$sql = "UPDATE marketplace SET 
 			name = '$name',
 			ing_brand = '$brand',
 			price = '$price',
 			in_unit = '$unit',
 			ing_section = '$section',
 			ing_category = '$section',
 			date_modified = '$dateModified' 
 			WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {	
	

	} else {
		echo "Something went wrong";
	    exit();
	}

	header("location: ingridient-marketplace-setup.php?msg=success");
		 	

 }else{

 	  header("location: ingridient-marketplace-setup.php?msg=error");
 }

?>