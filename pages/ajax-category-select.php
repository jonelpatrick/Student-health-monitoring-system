<?php 
require '../connection/dbconnect.php';

$section = $_GET['section'];
?>
 Filter Category
<select id="dd_category" name="dd_category" class="form-control">
<?php 

  $sql = "SELECT ing_category FROM Marketplace WHERE ing_section = '$section' ORDER BY id DESC";
  $result = mysqli_query($mysqli,$sql);  
  if (mysqli_num_rows($result) > 0) {                                     
  	 echo '<option value="All">All</option>';
    while($row = mysqli_fetch_assoc($result)) {

      $category = $row['ing_category'];
      echo '<option value="'.$category.'">'.$category.'</option>';
    }
  }
  ?>
</select>