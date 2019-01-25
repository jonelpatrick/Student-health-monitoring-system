<?php

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "student-health-monitoring-system"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM marketplace WHERE name like'%".$search."%' AND deleted = 0";
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array("value"    => $row['id'],
   					   "label"    => $row['name'],
   					   "brand"    => $row['ing_brand'],
   					   "price"    => $row['price'],
   					   "unit"     => $row['in_unit'],
   					   "section"  => $row['ing_section'],
   					   "category" => $row['ing_category']
   					   );
 }

 echo json_encode($response);
}

exit;