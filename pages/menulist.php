<?php
	include '../template/header.php';
	include 'calendar.php';

?>
<link href="calendar.css" type="text/css" rel="stylesheet" />
<link href="../dist/css/calendar.css" rel="stylesheet">
<style type="text/css">
    .spanLink{
        color:#08c;
        margin-left:2px ;        
    }
    .spanLink:hover{
        color: red;
        text-decoration: underline;
    }
    .partner-link{
        width: 300px;
        float: right;
    }
    #ui-id-1{
      z-index: 2000;
    }
    #allotedBudget{
      max-width: 130px;
    }
      

</style>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-shopping-basket fa-fw"></i>Menu Plan
                  <div class="partner-link">
                    <a href="https://www.palengkeboy.com/">
                      <img src="../upload/logo-palengkeboy.png" alt="https://www.palengkeboy.com/">
                    </a>
                </div>
                </h1>
                <input type="hidden" name="privilege" id="userPrivilege" value="<?php echo $_SESSION['privilege']; ?>">
                <input type="hidden" name="login_id" id="login_parent" value="<?php echo $_SESSION['login_id']; ?>">
                
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
            	<?php 

            	$calendar = new Calendar();
				      echo $calendar->show();
				
            	?>
            </div>
        </div>
 </div>
       <!-- modal menu dialog for menu-->


        <div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Menu Detail of <span id="menuDate" style="color:orange;"></span></h4>
                        <h5 id="displayResult" style="display: none;"></h5>
                        
                    </div>
                    
                    <div class="modal-body">

                         
                    </div><!--modal body -->
                    <div class="modal-footer">  
                       
                         <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button id="btnMenuDelete" onclick="actionMenu('delete');" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                         <button id="btnMenuUpdate" onclick="actionMenu('update');" type="button" class="btn btn-success" >Update</button>
                         <button id="btnMenuSave" onclick="actionMenu('save');" type="button" class="btn btn-primary" >Save</button>                 
                    </div>
                   
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->



      <!-- modal menu dialog for liquidation-->

        <div class="modal fade" id="liquidationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelLiquidation" aria-hidden="true" >
            <div class="modal-dialog" style="width: 800px;margin-top: 0;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelLiquidation">Liquidation of <span id="liquidationDate" style="color:orange;"></span></h4>                                                
                    </div>

                    <form id="myform" action="liquidation-process.php" method="post" enctype="multipart/form-data" onsubmit="validateFormInput();" >

                        <div class="modal-body liquidation-modal-body">

                             
                        </div><!--modal body -->
                        <div class="modal-footer">  
                             <button  type="button" class="btn btn-success" onclick="generateReport();"><i class="fa fa-file-pdf-o"></i> PRINT PDF</button>   
                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>                         
                                                        
                             <input type="submit" id="btnLiquidationSave"  name="submit" class="btn btn-primary" value="Save">            
                        </div>
                   </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->





<script type="text/javascript">

  function generateReport(){

    var menuName = document.getElementById('menuNameLiquidation').value;
    var menuId = document.getElementById('menuIdLiquidation').value;
   
    window.open('generate-pdf-liquidation.php?menuId=' + menuId + '&menuName=' + menuName);
  }
 
    function addIngridient(action){

        var ingridient = document.getElementById('ingridientName').value;
        var budget = document.getElementById('budget').value;
        var ingridientId = document.getElementById('ingridientId').value;
        var quantity = document.getElementById('quantity').value;
        var action = action;
        var menuId = document.getElementById('menu_id').value;
        var price  = document.getElementById('price').value;
        price.slice(2);
        budget.slice(2);
        $.ajax({
            type: 'post',
            url: 'ajaxIngridient.php',
            data: {
             action:action,      
             ingridient:ingridient,
             budget:budget, 
             menuId:menuId,
             quantity:quantity,
             price:price,
             ingridientId: ingridientId,
            },
            success: function (response) {

             $( '#ingridientTable' ).html(response);
            }
        });
        
        clearIngridientData();

    }

    function calculate(){

        var table=document.getElementById('listofingridients');
        var count = table.getElementsByTagName('tr').length;

        if (count > 0)
          {
            var total = 0;
            for(var i = 1; i < count; i++)
              {
                row = table.rows[i].cells[5].innerHTML;
                rerow = row.slice(2);
                total += parseFloat(rerow);
                
              }
          }
          document.getElementById('totalBudget').innerHTML = total;    
          console.log(total);

          var allotedBudget = document.getElementById('allotedBudget').value;
          var totalExpenses = document.getElementById('totalBudget').innerHTML;
          //calculate remaining
          var remainingBudget = Math.round((allotedBudget - totalExpenses) * 100) / 100;

          document.getElementById('remainingBudget').innerHTML = remainingBudget ;
          if(remainingBudget < 0){
             document.getElementById('remainingBudget').style.color = "red";
          }else{
            document.getElementById('remainingBudget').style.color = "black";
          }

    }
    function autoCalculateBudget(){
      var quantity = document.getElementById('quantity').value;
      var price = document.getElementById('price').value;
      var budget = 0;
      budget =  price * quantity;
      document.getElementById('budget').value = budget;
    }

    function dynamicCalculate(action){
         var total = document.getElementById('totalBudget').innerHTML;
         var budget = document.getElementById('budget').value;
         var hidden_budget =document.getElementById('hidden_budget').value;
         var total2 =0;
         var totalBudget = 0;
         var remainingBudget = 0;
        
         if(action == 'save'){

            totalBudget = parseFloat(total) + parseFloat(budget);  
            
          

         }else if(action == 'edit'){

            total2 = parseFloat(total) - parseFloat(hidden_budget);

            totalBudget = parseFloat(total2) + parseFloat(budget); 
            
            

         }else if(action == 'delete'){
            
            totalBudget = parseFloat(total) - parseFloat(budget); 
            
           
         }

          document.getElementById('totalBudget').innerHTML = totalBudget; 

          var allotedBudget = document.getElementById('allotedBudget').value;  
          var totalExpenses = document.getElementById('totalBudget').innerHTML;        
           remainingBudget = allotedBudget - totalExpenses;
          console.log(remainingBudget); 
          
          document.getElementById('remainingBudget').innerHTML = Math.round(remainingBudget * 100) / 100;

          if(remainingBudget < 0){
             document.getElementById('remainingBudget').style.color = "red";
          }else{
            document.getElementById('remainingBudget').style.color = "black";
          }
    }

    function showRow(row){
        var privilege = document.getElementById('userPrivilege').value;     

        if(privilege == 'Parent' || privilege == 'CSSDO'){   
          
         
        }else{
           var x=row.cells;

          document.getElementById('ingridientId').value = x[0].innerHTML;
          document.getElementById('ingridientName').value = x[1].innerHTML;                  
          document.getElementById('quantity').value = x[2].innerHTML;

          document.getElementById('price').value = x[3].innerHTML.slice(2);
          document.getElementById('budget').value = x[4].innerHTML.slice(2);
          document.getElementById('hidden_budget').value = x[4].innerHTML.slice(2);

          document.getElementById('btnAdd').disabled = true;
          document.getElementById('btnDelete').disabled = false;
          document.getElementById('btnEdit').disabled = false;

        }
    }

    function clearIngridientData(){
        document.getElementById('ingridientName').value = "";
        document.getElementById('ingridientId').value = "";
        document.getElementById('budget').value = "";
        document.getElementById('quantity').value = "";
        document.getElementById('price').value = "";

        document.getElementById('btnAdd').disabled = false;
        document.getElementById('btnDelete').disabled = true;
        document.getElementById('btnEdit').disabled = true;
    }

    function actionMenu(action){
      
        var menuName = document.getElementById('menuName').value;
        var assignParent = document.getElementById('assignParent').value;
        var totalBudget = document.getElementById('totalBudget').innerHTML;
        var action = action;
        var chosenDate = document.getElementById('menuDate').innerHTML;
        var menuId = document.getElementById('menu_id').value;
        var alloted_budget = document.getElementById('allotedBudget').value;

        var remainingBudget = Number(document.getElementById("remainingBudget").innerHTML);
        if(remainingBudget > 0){
         $.ajax({
            type: 'post',
            url: 'ajaxMenu.php',
            data: {
             action: action,      
             menuName: menuName,
             assignParent: assignParent, 
             totalBudget: totalBudget,
             chosenDate: chosenDate,
             menuId: menuId,
             alloted_budget: alloted_budget,
             
            },
            success: function (response) {

             $( '#displayResult' ).html(response);
            }
        
        });         

        location.reload();
      }else{
        alert("Sorry, Remaining Budget is less than zero.");
      }

    }

    function getChosenDate(day){
       
        var chosenDate = document.getElementById('dateForToday'+day).value;
        document.getElementById('menuDate').innerHTML=chosenDate;

         window.history.pushState( {} , '', '?chosenDate='+ chosenDate );
        
        $('#menuModal').on('hidden.bs.modal', function () {
    
         location.reload();    
      
        });        
        
        $('.modal-body').load('get-dynamic-content.php?dateselected=' + chosenDate,function(){

            $('#menuModal').modal({show:true});
           
             disableMenubtn();
              readModeMenu();
        });
        
    }

    function readModeMenu(){
      var privilege = document.getElementById('userPrivilege').value;

      if(privilege == 'Parent' || privilege == 'CSSDO'){   

        document.getElementById('menuName').disabled = true;
        document.getElementById('assignParent').disabled = true;
        document.getElementById('ingridientName').disabled = true;
        document.getElementById('budget').disabled = true;
        document.getElementById('btnAdd').disabled = true;
        document.getElementById('listofingridients').disabled = true;
        document.getElementById('btnMenuDelete').disabled = true;
        document.getElementById('btnMenuUpdate').disabled = true;
        document.getElementById('btnMenuSave').disabled = true;
        document.getElementById('btnEdit').disabled = true;
        document.getElementById('btnDelete').disabled = true;
        document.getElementById("allotedBudget").readOnly = true;
      }
      if(privilege == 'DSWD'){
        document.getElementById("allotedBudget").readOnly = false;
      }
    }

    function readModeLiquidation(){
       var privilege = document.getElementById('userPrivilege').value;
      var assignparent = document.getElementById('assignedParent').value;
      var login_parent = document.getElementById('login_parent').value;

      if(assignparent == login_parent || privilege == 'CSSDO' || privilege == 'Administrator'){
         document.getElementById('btnLiquidationSave').disabled = false;
      }else{
          document.getElementById('uploadLiquidationFile').disabled = true;
          document.getElementById("showUploadedFiles").style.display = "none";
          document.getElementById('btnLiquidationSave').disabled = true;
          var numRows = document.getElementById('ingridients_num_rows').value;

          for(var i=0; i < numRows;){
            i++;
            document.getElementById('ingridientLiquidation' + i).disabled = true;
          }
      }
        
    }

    function disableMenubtn(){
         var menuId = document.getElementById('menu_id').value;

         if(menuId == 0 || menuId == ""){
            document.getElementById('btnMenuSave').disabled = false;
            document.getElementById('btnMenuDelete').disabled = true;
            document.getElementById('btnMenuUpdate').disabled = true;
         }else{
            document.getElementById('btnMenuSave').disabled = true;
            document.getElementById('btnMenuDelete').disabled = false;
            document.getElementById('btnMenuUpdate').disabled = false;
         }
    }

    function onloadCalculateLiquidation(){
      var numRows = document.getElementById('ingridients_num_rows').value;
      var total = 0;
      var liquidation = 0;
      var remaining = 0;
      for(var i = 0; i < numRows;){
        i++;
        liquidation = parseFloat(document.getElementById('ingridientLiquidation' + i).value);
        console.log(liquidation);
        total += liquidation;

      }
      console.log(total);
      document.getElementById('total_expenses').innerHTML = total;
      var tbudget = document.getElementById("total_budget").innerHTML;
      remaining = tbudget - total;
      document.getElementById("remainingBudget").innerHTML = remaining;
      
      if(remaining < 0){
           document.getElementById('remainingBudget').style.color = "red";
        }else{
          document.getElementById('remainingBudget').style.color = "black";
        }
    }

    function showLiquidationModal(day){

        
        var chosenDate = document.getElementById('dateForToday'+day).value;
        document.getElementById('liquidationDate').innerHTML=chosenDate;


        $('.liquidation-modal-body').load('get-dynamic-content-liquidation.php?dateselected=' + chosenDate,function(){
             
            $('#liquidationModal').modal({show:true}); 
            readModeLiquidation();                   
            onloadCalculateLiquidation();
        });
                
    }

    function liquidationOnkeyRelease(){
        
        var numRows = document.getElementById('ingridients_num_rows').value;
        var total_budget = parseFloat(document.getElementById('total_budget').innerHTML);
        var expense = 0;
        var total_expenses = 0;

        for(var i = 0; i < numRows; ){
            i++;
            expense = parseFloat(document.getElementById('ingridientLiquidation'+i).value) ;
            total_expenses += expense;
        }

        document.getElementById('total_expenses').innerHTML = total_expenses;

        if(total_expenses > total_budget){
            document.getElementById("total_expenses").style.color = "#ff0000";
        }else{
            document.getElementById("total_expenses").style.color = "#333";
        }

        var expenses2 = document.getElementById('total_expenses').innerHTML;
        var budget2 = document.getElementById('total_budget').innerHTML;
        var remaining = budget2 - expenses2;
        document.getElementById('remainingBudget').innerHTML =  Math.round(remaining * 100) / 100;
    }

    function validateFormInput(){

         var total_budget = parseFloat(document.getElementById('total_budget').innerHTML);
         var total_expenses = parseFloat(document.getElementById('total_expenses').innerHTML);

        if(total_expenses > total_budget){

          alert('You have exceeded the budget. Please check');
            event.preventDefault();
            return false;
        }else{

            return true;
        }

    }

    function showfiles(liquidationId,menuId){

         $('#showfiles').load('showfiles.php?lId=' + liquidationId + '&mId=' + menuId,function(){                                    

        });
         
    }

    function removefiles(fileId,liquidationId,menuId){

      $('#showfiles').load('removefiles.php?id=' + fileId + '&file=' + document.getElementById('file' + fileId).value + '&lId=' + liquidationId + '&mId=' + menuId,function(){                                    

        });
 
    }

    function changeRemainingByAlloted(){
      var finalResult = 0;
      var alloted = Number(document.getElementById("allotedBudget").value);
      var totalBudget = Number(document.getElementById("totalBudget").innerHTML);

      
        finalResult = Math.round((alloted - totalBudget) * 100) / 100;
      
      document.getElementById("remainingBudget").innerHTML = finalResult;
      if(finalResult > 0){
        document.getElementById('remainingBudget').style.color = "black";
      }else{
        document.getElementById('remainingBudget').style.color = "red";
      }
    }

  
</script>
<?php
	include '../template/footer.php';
?>
