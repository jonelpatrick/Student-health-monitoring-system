<?php
require '../connection/dbconnect.php';

if(!empty($_GET['dateselected'])){

$chosenDate = $_GET['dateselected'];
$menu_name = "";
$menu_id = "";
$total_budget = "";
$parent_id = "";
$parent_fname = "";
$parent_mname = "";
$parent_lname = "";

//menu
 $sql_menu = "SELECT tbl_menu.id mid, `menu` mmenu, `total_budget` mbudget, `parent_id` mparentid,tbl_admin.firstname afname,tbl_admin.middlename amname,tbl_admin.lastname alname,`date_chosen` mdate FROM `tbl_menu` INNER JOIN tbl_admin on tbl_menu.parent_id=tbl_admin.id WHERE tbl_menu.date_chosen = '$chosenDate'";

    $result_menu = mysqli_query($mysqli,$sql_menu);

    if (mysqli_num_rows($result_menu) > 0) {     

        while($row = mysqli_fetch_assoc($result_menu)) {

            $menu_id = $row['mid'];
            $menu_name = $row['mmenu'];                
            $total_budget = $row['mbudget'];
            $parent_id = $row['mparentid'];
            $parent_fname = $row['afname'];
            $parent_mname = $row['amname'];
            $parent_lname = $row['alname'];
                        
        }
    }
    $parent_name = $parent_fname." ".$parent_mname." ".$parent_lname;

    //liquidation
    $liquidation_id = "";
    $total_expenses = 0;
    $liquidation_file_name = "";


    $sql_liquidation = "SELECT * FROM tbl_liquidation WHERE menu_id = '$menu_id'";
    $result_liquidation = mysqli_query($mysqli,$sql_liquidation);

    if(mysqli_num_rows($result_liquidation) > 0){

    	 while($row = mysqli_fetch_assoc($result_liquidation)) {
    		
    		$liquidation_id = $row['id'];
    		$total_expenses = $row['total_expenses'];
    		$liquidation_file_name = $row['file_name'];

    	}
    }

?>
<style type="text/css">
  .divright{
    float: right;
    width: 33%;
  }
  input[type="text"]{
    width: 80% !important; 
  }
</style>
  <input type="hidden" name="parent_id" id="assignedParent" value="<?php echo $parent_id; ?>">
	<input type="hidden" id="liquidationId" name="liquidationId" value="<?php echo $liquidation_id; ?>">
	<input type="hidden" id="menuIdLiquidation" name="menuId" value="<?php echo $menu_id; ?>">
  <input type="hidden" id="menuNameLiquidation" name="menuName" value="<?php echo $menu_name; ?>">
	<div class="radio-inline">
	  <div class="form-group"> 
	  	<label>Menu : <span style="font-weight: 600;text-transform: uppercase;"><?php echo $menu_name; ?></span></label>
	  </div>
	
	</div>
<br>
	<div class="radio-inline">
	  <div class="form-group"> 
	  	<label>Assigned Parent : <span style="font-weight: 600;text-transform: uppercase;" ><?php echo $parent_name; ?></span></label>
	  </div>
	 
	</div>
<div class="divright">
    <div class="form-group"> 
      <label>Total Budget : &#x20B1; <span id="total_budget" style="font-weight: 600;text-transform: uppercase;" ><?php echo $total_budget; ?></span></label>
    </div>
     <div class="form-group"> 
      <label>Total Expense : &#x20B1; <span id="total_expenses" style="font-weight: 600;text-transform: uppercase;font-size: 20px;" ><?php echo $total_expenses; ?></span></label>
    </div>
    <div class="form-group"> 
      <label>Remaining Budget : &#x20B1; <span id="remainingBudget" style="font-weight: 600;text-transform: uppercase;font-size: 20px;" ></span></label>
    </div>
</div>
	<div class="radio-inline">

		<div class="form-group" >
			<input type="file" name="uploadLiquidationFile[]" id="uploadLiquidationFile" class="form-control" style="height: 45px;"  multiple >			
		</div>

		<div class="form-group">
			<span id="showUploadedFiles" class="btn btn-success" onclick="showfiles(<?php echo $liquidation_id.','.$menu_id; ?>);">Show uploaded files <i class="fa fa-file"></i></span>
		</div>
		
		<div id="showfiles">

		</div>

	</div>
	<div class="panel-default">
		 <div class="panel-heading">
		   <strong> Ingridients Detail</strong>
		 </div>
		 <div class="panel-body">
		 	  <div id="ingridientTable">
               <table width="100%" class="table table-striped table-bordered table-hover" id="listofingridients">
               <thead>
                <col width="40">
  				<col width="300">
  				
               <tr>
                    <th>ID</th>
                   <th>Ingridient</th>
                    <th>Qty</th>
                   <th>Budget</th>
                   <th></th>
                   <th >Total Expenses</th>
               </tr>
               </thead>
               <tbody>

               <?php
               
                    $sql = "SELECT * FROM tbl_ingridients where menu_id='$menu_id'";

                    $result = mysqli_query($mysqli,$sql);

                     if (mysqli_num_rows($result) > 0) {  
                     	$i = 0;
                     	echo '<input id="ingridients_num_rows" name="ingridients_num_rows" type="hidden" value = "'.mysqli_num_rows($result).' "';
                        while($row = mysqli_fetch_assoc($result)) {
                        	$i++;
                            echo '<tr onclick="javascript:showRow(this);">';
                            echo '<input type="hidden" name="ingridientId['.$i.']" value="'.$row['id'].'">';
                            echo ' <td>'.$row['id'].'</td>';
                            echo ' <td>'.$row['ingridient'].'</td>';
                             echo ' <td>'.$row['quantity'].'</td>';
                            echo ' <td>&#x20B1; '.$row['budget'].'</td>';
                            echo ' <td> = </td>';
                            echo ' <td >&#x20B1; <input id = "ingridientLiquidation'.$i.'" name="ingridientLiquidation['.$i.']" type = "text" value = "'.$row['liquidation'].'" style="width: 100%;" onkeyup="liquidationOnkeyRelease();"></td>';
                            echo '</tr>';

                          }
                     }
               ?>
                                                    
               </tbody>
               </table>
            </div>
		 </div>
	</div>

<?php

}

?>