<?php
require '../connection/dbconnect.php';


if(!empty($_GET['dateselected'])){
	//delete undefined ingridients
	$sql_delete_ingridients = "DELETE FROM tbl_ingridients WHERE menu_id = 0";
	mysqli_query($mysqli,$sql_delete_ingridients);


   $chosenDatel = $_GET['dateselected'];
   $menu_namel="";
   $menu_idl = "";
   $total_budgetl = "";
   $parent_idl = "";
   $date_chosenl = "";
   $alloted_budget = 0;
   $sql = "SELECT * FROM tbl_menu WHERE date_chosen = '$chosenDatel'";

    $result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {     

        while($row = mysqli_fetch_assoc($result)) {

            $menu_idl = $row['id'];
            $menu_namel = $row['menu'];    
            $total_budgetl = $row['total_budget'];
            $parent_idl = $row['parent_id'];
            $date_chosenl = $row['date_chosen'];
            $alloted_budget = $row['alloted_budget'];
        }
    }
    if($alloted_budget == 0 || $alloted_budget == ""){
      $alloted_budget = 0;
    }
 ?>
    
     <div class="form-group"> 
                          
        <label class="radio-inline">Menu Name:
      
        <input id="menuName" value="<?php echo ''.$menu_namel; ?>" type="text" name="menu_name" placeholder="Enter Menu name here" style="width: 70%;color: #212121;text-transform: uppercase;font-weight: 600;font-size: 13px;" required>
        <input type="hidden" name="menu_id" id="menu_id" value="<?php echo $menu_idl; ?>">
        </label>
        <div style="float: right;width: 36%;">
          <label> Alloted Budget:[Filled by DSWD] <br>&#x20B1; <input type="text" name="allotedBudget" id="allotedBudget" placeholder="0" value="<?php echo $alloted_budget; ?>" onkeyup = "changeRemainingByAlloted();" step=".01"></label>
          <label >Total Expenses: &#x20B1;  <span id="totalBudget" style="font-size: 18px;font-weight: 800;"><script type="text/javascript">calculate();</script></span></label>          
          <label>Remaining Budget: &#x20B1; <span id="remainingBudget" style="font-size: 18px;font-weight: 800;"></span></label>
        </div>
     </div> 
     <!-- assign parents-->
      <div class="radio-inline">
        <div class="form-group">
              <label>Assign Parent:<br>
                  <select id="assignParent" >
                <?php 
                     $sql_parent ="SELECT * From tbl_admin where privilege='Parent' ORDER BY lastname asc";
                     $result = mysqli_query($mysqli,$sql_parent);

                    if (mysqli_num_rows($result) > 0) {                                     

                        while($row = mysqli_fetch_assoc($result)) {
                            $parent_name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'];
                            echo '<option  value="'.$row['id'].'" '.(($row['id'] == $parent_idl ) ? 'selected = "selected "':"").' >'.$parent_name.' </option>';
                        }
                    }
                ?>                                        
                </select>
            </label>
        </div>
    </div> 
   
     <div class="panel-default">
         <div class="panel-heading">
           <strong> Ingridients Detail</strong>
         </div>
         <div class="panel-body">

             <div class="radio-inline" style="padding-left:0px;">
                 <label >Ingridient Name:<br>
                  <input id="ingridientId" type="hidden" name="Ingridient_id">
                  <input id="hidden_budget" type="hidden" name="hidden_budget">
                  <input id="hidden_quantity" type="hidden" name="hidden_quantity">
                  <input id="ingridientName" type="text" name="Ingridient_name" placeholder="Ingridient name" style="width: 150px;">
                  <input id="quantity" type="text" name="quantity" placeholder="Quantity" style="width: 100px;" onkeyup="autoCalculateBudget();">
                  <input id="price" type="text" name="price" placeholder="Price" style="width: 100px;" onkeyup="autoCalculateBudget();">
                  <input id="budget" type="text" name="budget" placeholder="Budget" style="width: 100px;" readonly="">
             </label>                           
             </div>
             <div class="modal-button02" style="float: right;margin:1em 0;">
              
                 <button id="btnDelete" disabled class="btn btn-danger" onclick="dynamicCalculate('delete'); addIngridient('delete');"><i class="fa fa-close"></i></button>                             
                 <button id="btnEdit" disabled class="btn btn-success" onclick="dynamicCalculate('edit'); addIngridient('edit');"><i class="fa fa-edit"></i></button>
                 <button id="btnAdd" class="btn btn-primary" onclick="dynamicCalculate('save'); addIngridient('save');"><i class="fa fa-plus"></i></button>

             </div>
           <div style="margin-top: 1em;width: 100%;height: 300px;">
            <div id="ingridientTable">
               <table width="100%" class="table table-striped table-bordered table-hover" id="listofingridients">
                <col width="40">
  				<col width="300">
               <thead>
               <tr>
                    <th>ID</th>
                   <th>Ingridient</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Alloted Budget</th>
                   <th>Total</th>
               </tr>
               </thead>
               <tbody>

               <?php
               
                    $sql = "SELECT * FROM tbl_ingridients where menu_id='$menu_idl'";

                    $result = mysqli_query($mysqli,$sql);

                     if (mysqli_num_rows($result) > 0) {  

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
                     }
               ?>
                                                    
               </tbody>
               </table>
            </div>
           </div>
           
         </div>
     </div>
  <?php

}else{
    echo 'Content not found....';
}
?>

<input type="hidden" id="selectuser_id" >
<!-- fetch data autocomplete  -->

<script type="text/javascript">

  $( function() {

 
     // Single Select
     $( "#ingridientName" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "fetchDataAutocomplete.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
         console.log(data);
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#ingridientName').val(ui.item.label); // display the selected text
       $('#selectuser_id').val(ui.item.value); // save selected id to input
       $('#price').val(ui.item.price); // save selected id to input
       return false;
      }
     });

  });

function split( val ) {
   return val.split( /,\s*/ );
}
function extractLast( term ) {
   return split( term ).pop();
}
</script>

