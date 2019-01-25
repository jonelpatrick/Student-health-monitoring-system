<?php
require '../connection/dbconnect.php';
$id = $_GET['id'];
$sex = $_GET['sex'];

if($sex == 'boys'){
	$sql = "SELECT 
        id,
        age,
        severely_underweight,
        underweight_from,
        underweight_to,
        normal_from,
        normal_to,
        overweight
        FROM boys_growth_table 
        WHERE id = '$id'";  

}else{

	$sql = "SELECT 
        id,
        age,
        severely_underweight,
        underweight_from,
        underweight_to,
        normal_from,
        normal_to,
        overweight
        FROM girls_growth_table 
        WHERE id = '$id'";  
}

$result = mysqli_query($mysqli,$sql);

if (mysqli_num_rows($result) > 0) {                                     
    while($row = mysqli_fetch_assoc($result)) {

    	$age = $row['age'];
    	$severely_underweight = $row['severely_underweight'];
    	$underweight_from = $row['underweight_from'];
    	$underweight_to = $row['underweight_to'];
    	$normal_from = $row['normal_from'];
    	$normal_to = $row['normal_to'];
    	$overweight = $row['overweight'];
    }
}


?>
<input type="hidden" name="sex" value="<?php echo $sex; ?>">
<input type="hidden" name="growth_id" value="<?php echo $id; ?>">
<div class="form-group">
    <label>Age</label>
    <input type="text" name="age" class="form-control" value="<?php echo $age; ?>">
</div>
<div class="form-group">
    <label>Severely Underweight</label>
    <input type="text" name="severely_underweight" class="form-control" value="<?php echo $severely_underweight; ?>">
</div>
<div class="form-group">
    <label>Underweight From</label>
    <input type="text" name="underweight_from" class="form-control" value="<?php echo $underweight_from; ?>">
</div>
<div class="form-group">
    <label>Underweight To</label>
    <input type="text" name="underweight_to" class="form-control" value="<?php echo $underweight_to; ?>">
</div>
<div class="form-group">
    <label>Normal From</label>
    <input type="text" name="normal_from" class="form-control" value="<?php echo $normal_from; ?>">
</div>
<div class="form-group">
    <label>Normal TO</label>
    <input type="text" name="normal_to" class="form-control" value="<?php echo $normal_to; ?>">
</div>
<div class="form-group">
    <label>Overweight</label>
    <input type="text" name="overweight" class="form-control" value="<?php echo $overweight; ?>">
</div>