<?php
	require '../connection/dbconnect.php';

	$chosenDate = $_POST['chosenDate'];
	$sql = "SELECT * FROM tbl_menu WHERE date_chosen = '$chosenDate'";

	$result = mysqli_query($mysqli,$sql);

	if (mysqli_num_rows($result) > 0) {     

		while($row = mysqli_fetch_assoc($result)) {


		}
	
?>
	<!-- result is not empty-->
	<div class="modal-body">asdasd not empty
         <div class="form-group"> 
            <label class="radio-inline">Menu Name:
            <input id="menuName" type="text" name="menu_name" placeholder="Enter Menu name here" style="width: 60%;" required>
            </label>
            <label class="radio-inline" >Total Budget: <span id="totalBudget" style="font-size: 18px;font-weight: 800;">20000.00</span></label>
         </div> 
         <div class="panel-default">
             <div class="panel-heading">
               <strong> Ingridients Detail</strong>
             </div>
             <div class="panel-body">

                 <div class="radio-inline">
                     <label >Ingridient Name:
                      <input id="ingridientId" type="hidden" name="Ingridient_id">
                      <input id="hidden_budget" type="hidden" name="hidden_budget">
                     <input id="ingridientName" type="text" name="Ingridient_name" placeholder="Enter Ingridient name here">
                     <input id="budget" type="text" name="budeget" placeholder="Enter Budget here" style="width: 140px;">
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
                   <thead>
                   <tr>
                        <th>ID</th>
                       <th>Ingridient</th>
                       <th>Budget</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php
                        $sql = "SELECT * FROM tbl_ingridients where menu_id=0";
                        $result = mysqli_query($mysqli,$sql);
                         if (mysqli_num_rows($result) > 0) {  
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<tr onclick="javascript:showRow(this);">';
                                echo ' <td>'.$row['id'].'</td>';
                                echo ' <td>'.$row['ingridient'].'</td>';
                                echo ' <td>'.$row['budget'].'</td>';
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
       
    </div>
    <div class="modal-footer">  
        <div class="radio-inline">
            <div class="form-group">
                <label>Assign Parent:
                    <select id="assignParent">
                    <?php 
                         $sql_parent ="SELECT * From tbl_admin where privilege='Parent' ORDER BY lastname asc";
                         $result = mysqli_query($mysqli,$sql_parent);

                        if (mysqli_num_rows($result) > 0) {                                     

                            while($row = mysqli_fetch_assoc($result)) {
                                $parent_name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'];
                                echo '<option value='.$row['id'].'>'.$parent_name.' </option>';
                            }
                        }
                    ?>                                        
                    </select>
                </label>
            </div>
        </div> 
        <div class="clear-fix"></div>
         <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button onclick="actionMenu('delete');" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
         <button onclick="actionMenu('update');" type="button" class="btn btn-success" data-dismiss="modal">Update</button>
                       
    </div>
<!-- end of result is not empty-->
<?php
	}else{
?>
<!-- result is empty-->
asdasd  empty
	<div class="modal-body">
         <div class="form-group"> 
            <label class="radio-inline">Menu Name:
            <input id="menuName" type="text" name="menu_name" placeholder="Enter Menu name here" style="width: 60%;" required>
            </label>
            <label class="radio-inline" >Total Budget: <span id="totalBudget" style="font-size: 18px;font-weight: 800;">20000.00</span></label>
         </div> 
         <div class="panel-default">
             <div class="panel-heading">
               <strong> Ingridients Detail</strong>
             </div>
             <div class="panel-body">

                 <div class="radio-inline">
                     <label >Ingridient Name:
                      <input id="ingridientId" type="hidden" name="Ingridient_id">
                      <input id="hidden_budget" type="hidden" name="hidden_budget">
                     <input id="ingridientName" type="text" name="Ingridient_name" placeholder="Enter Ingridient name here">
                     <input id="budget" type="text" name="budeget" placeholder="Enter Budget here" style="width: 140px;">
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
                   <thead>
                   <tr>
                        <th>ID</th>
                       <th>Ingridient</th>
                       <th>Budget</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php
                        $sql = "SELECT * FROM tbl_ingridients where menu_id=0";
                        $result = mysqli_query($mysqli,$sql);
                         if (mysqli_num_rows($result) > 0) {  
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<tr onclick="javascript:showRow(this);">';
                                echo ' <td>'.$row['id'].'</td>';
                                echo ' <td>'.$row['ingridient'].'</td>';
                                echo ' <td>'.$row['budget'].'</td>';
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
       
    </div>
    <div class="modal-footer">  
        <div class="radio-inline">
            <div class="form-group">
                <label>Assign Parent:
                    <select id="assignParent">
                    <?php 
                         $sql_parent ="SELECT * From tbl_admin where privilege='Parent' ORDER BY lastname asc";
                         $result = mysqli_query($mysqli,$sql_parent);

                        if (mysqli_num_rows($result) > 0) {                                     

                            while($row = mysqli_fetch_assoc($result)) {
                                $parent_name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'];
                                echo '<option value='.$row['id'].'>'.$parent_name.' </option>';
                            }
                        }
                    ?>                                        
                    </select>
                </label>
            </div>
        </div> 
        <div class="clear-fix"></div>
         <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button onclick="actionMenu('delete');" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
         <button onclick="actionMenu('update');" type="button" class="btn btn-success" data-dismiss="modal">Update</button>
         <button onclick="actionMenu('save');" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>                 
    </div>
 <!--end of result is  empty-->   
<?php		
	}
 ?>