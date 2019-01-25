<?php 
	require '../connection/dbconnect.php';
    include '../pages/session.php';

    $action = $_POST['action'];
    $_SESSION['ERR']="";

    switch ($action) {

    	case 'addGrowth':
    		addGrowth($mysqli);
    		break;

    	case 'editGrowth':    
    		if($_POST['submit'] == 'Save'){
    			editGrowth($mysqli);    		
    		} else{
    			deleteGrowth($mysqli);
    		}   		
    		break;
    	    	
    }
    function deleteGrowth($mysqli){

    	$id = $_POST['growth_id'];
    	$sex = $_POST['sex'];

    	if($sex == 'boys'){

			$sql = "DELETE FROM boys_growth_table WHERE id = '$id'";

		}else{
			
			$sql = "DELETE FROM girls_growth_table WHERE id = '$id'";

		}
	
		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
			 
		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(0812B)";
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
    function editGrowth($mysqli){

    	$id = $_POST['growth_id'];
    	$age = $_POST['age'];
		$severely_underweight = $_POST['severely_underweight'];
		$underweight_from = $_POST['underweight_from'];
		$underweight_to = $_POST['underweight_to'];
		$normal_from = $_POST['normal_from'];
		$normal_to = $_POST['normal_to'];
		$overweight = $_POST['overweight'];
		$sex = $_POST['sex'];
		

		if($sex == 'boys'){

			$sql = "UPDATE boys_growth_table
					SET 
					age = '$age',
					severely_underweight = '$severely_underweight',
					underweight_from = '$underweight_from',
					underweight_to = '$underweight_to',
					normal_from = '$normal_from',
					normal_to = '$normal_to',
					overweight = '$overweight'
					WHERE id = '$id'";
		}else{

			$sql = "UPDATE girls_growth_table
					SET 
					age = '$age',
					severely_underweight = '$severely_underweight',
					underweight_from = '$underweight_from',
					underweight_to = '$underweight_to',
					normal_from = '$normal_from',
					normal_to = '$normal_to',
					overweight = '$overweight'
					WHERE id = '$id'";

		}
	
		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
			 
		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(0812)";
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function addGrowth($mysqli){

    	$age = $_POST['age'];
		$severely_underweight = $_POST['severely_underweight'];
		$underweight_from = $_POST['underweight_from'];
		$underweight_to = $_POST['underweight_to'];
		$normal_from = $_POST['normal_from'];
		$normal_to = $_POST['normal_to'];
		$overweight = $_POST['overweight'];
		$sex = $_POST['sex'];

		if($sex == 'boys'){

			$sql = "INSERT INTO boys_growth_table
				(age,
				severely_underweight,
				underweight_from,
				underweight_to,
				normal_from,
				normal_to,
				overweight)
				VALUES
				('$age',
				'$severely_underweight',
				'$underweight_from',
				'$underweight_to',
				'$normal_from',
				'$normal_to',
				'$overweight')";
		}else{

			$sql = "INSERT INTO girls_growth_table
				(age,
				severely_underweight,
				underweight_from,
				underweight_to,
				normal_from,
				normal_to,
				overweight)
				VALUES
				('$age',
				'$severely_underweight',
				'$underweight_from',
				'$underweight_to',
				'$normal_from',
				'$normal_to',
				'$overweight')";

		}
	
		if (mysqli_query($mysqli,$sql)) {

			$_SESSION['ERR']="";		
			 
		} else {
			
		   $_SESSION['ERR']="Something went wrong: error(0812)";
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

?>