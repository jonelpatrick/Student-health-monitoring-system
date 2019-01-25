<?php
require '../connection/dbconnect.php';

$age = $_GET['age'];
$sex = $_GET['sex'];
$weight = $_GET['weight'];

$severely_underweight = "";
$underweight_from = "";
$underweight_to = "";
$normal_from = "";
$normal_to = "";	
$overweight = "";

if($sex == 1){

	$sql = "SELECT 
			severely_underweight,
			underweight_from,
			underweight_to,
			normal_from,
			normal_to,
			overweight
			FROM boys_growth_table
			WHERE age = '$age'";

}else{

	$sql = "SELECT 
			severely_underweight,
			underweight_from,
			underweight_to,
			normal_from,
			normal_to,
			overweight
			FROM girls_growth_table
			WHERE age = '$age'";
}

$result = mysqli_query($mysqli,$sql);
if (mysqli_num_rows($result) > 0) {                                     

    while($row = mysqli_fetch_assoc($result)) {

    	$severely_underweight = $row['severely_underweight'];
    	$underweight_from = $row['underweight_from'];
    	$underweight_to = $row['underweight_to'];
    	$normal_from = $row['normal_from'];
    	$normal_to = $row['normal_to'];
    	$overweight = $row['overweight'];
    }
 }
$severely_underweight = floatval($severely_underweight);
$underweight_from = floatval($underweight_from);
$underweight_to = floatval($underweight_to);
$normal_from = floatval($normal_from);
$normal_to = floatval($normal_to);	
$overweight = floatval($overweight);

switch ($weight) {

	case ($weight <= $severely_underweight):
		echo '<span style="color:red;">Severely Underweight</span>';
		break;

	case ($weight >= $underweight_from && $weight <= $underweight_to):
		echo '<span style="color:#ec750e;">Underweight</span>';
		break;
	
	case ($weight >= $normal_from && $weight <= $normal_to):
		echo "Normal";
		break;

	case ($weight >= $overweight):
		echo '<span style="color:#d70ee4;">Overweight</span>';
		break;

	default:
		echo '<span style="color:green;">Not in the Table</span>';
		break;
}
/*
echo $severely_underweight.'<br>';
echo $underweight_from.'<br>';
echo $underweight_to.'<br>';
echo $normal_from.'<br>';
echo $normal_to.'<br>';
echo $overweight.'<br>';
*/
/*
$string = "2968789218";
echo 'Original: ' . floatval($string) . PHP_EOL;
$string.= ".0";
$float = floatval($string);
echo 'Corrected: ' . $float . PHP_EOL;
*/
?>