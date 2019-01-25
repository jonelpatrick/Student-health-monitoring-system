 <?php 
 	require '../connection/dbconnect.php';

 	$id = $_GET['id'];

 	$sql = " SELECT * FROM marketplace WHERE id = '$id'";
 	$result = mysqli_query($mysqli,$sql);

	if (mysqli_num_rows($result) > 0) {                                     

      while($row = mysqli_fetch_assoc($result)) {
                
          $id            = $row['id'];
          $name          = $row['name'];
          $brand         = $row['ing_brand'];
          $price         = $row['price'];
          $unit          = $row['in_unit'];
          $category      = $row['ing_category'];
          $Section       = $row['ing_section'];
          $date_modified = $row['date_modified'];

          
      }
	}

 ?>
 <input type="hidden" name="marketIngId" value="<?php echo $id; ?>">
 <div class="form-group">                                   
 <small>Ingridient Name</small> 
    <input  type="text" class="form-control"  name="ing_name" placeholder="Ingridient Name" value="<?php echo $name; ?>" required>                                       
</div>

<div class="form-group">                                   
<small>Brand Name</small> 
    <input  type="text" class="form-control"  name="brand_name" placeholder="Brand Name : if none type [No Brand]" value="<?php echo $brand; ?>" required>                                       
</div>

<div class="form-group">                                   
<small>Price</small> 
    <input  type="Number" class="form-control"  name="price" placeholder="Price [Must be proportional to the unit]" required value="<?php echo $price; ?>">                                       
 </div>

<div class="form-group">                                   
 <small>Unit</small> 
 	<input  type="text" class="form-control"  name="unit" placeholder="Unit ex. 250 kg, kg, gm, pc" required value="<?php echo $unit; ?>">                                       
</div>

<div class="form-group">
 <small>Category</small>                                  
 	<input  type="text" class="form-control"  name="category" placeholder="Category ex. Fish, Meat, Shrimp or Not applicable " value="<?php echo $category; ?>" required>                                       
</div>

   <div class="form-group">
<hr/>
    <label><b>Ingridient Section &nbsp;</b></label>

   <label class="radio-inline">
      <input type="radio" name="optionsRadioSection" id="optionsRadioMeat" value="0" <?php if($category=="Meat"){echo 'checked';} ?> >Meat
  </label>
  <label class="radio-inline">
      <input type="radio" name="optionsRadioSection" id="optionsRadioSeafoods" value="1" <?php if($category=="Seafoods"){echo 'checked';} ?> >Seafoods
  </label>    
   <label class="radio-inline">
      <input type="radio" name="optionsRadioSection" id="optionsRadioVegetables" value="2" <?php if($category=="Meat"){echo 'Vegetables';} ?>  >Vegetables
  </label>  
   <label class="radio-inline">
      <input type="radio" name="optionsRadioSection" id="optionsRadioFruits" value="3" <?php if($category=="Fruits"){echo 'checked';} ?> >Fruits
  </label>  
   <label class="radio-inline">
      <input type="radio" name="optionsRadioSection" id="optionsRadioSpices" value="4" <?php if($category=="Spices"){echo 'checked';} ?> >Spices
  </label>
   <label class="radio-inline">
      <input type="radio" name="optionsRadioSection" id="optionsRadioOthers" value="5" <?php if($category=="Others"){echo 'checked';} ?> >Others
  </label>                                                                
</div>    