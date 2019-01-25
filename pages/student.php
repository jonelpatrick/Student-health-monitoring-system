<?php
	include '../template/header.php';
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-mortar-board fa-fw"></i>Pupil</h1>
            </div>
            <!-- /.col-lg-12 -->
             <!-- /.col-lg-12 -->
            <?php 
                if(isset($_GET['msg'])){
                if($_GET['msg']=='success'){ 
            ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Transaction is Successful</strong> 
                    </div>
            <?php    }else if($_GET['msg']=='error'){  ?>
                      <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>Transaction Fail</strong> Please Upload Image.
                    </div>  
            <?php    }else{ } }?>
        </div>
          <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Student Personal Detail        
                    </div>
                    <div class="panel-body">
                    
                        <div class="col-lg-3">
                         
                          
                            <!--BMIcalc -->
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                Calculate BMI Here.
                              </div>
                              <div class="panel-body">
                               <div class="form-group"> 
                                 <input id="ageLeft" type="text" name="ageLeft" class="form-control" placeholder="Age (Month)" style="margin-bottom: 1em;">
                               <input type="hidden" name="health-id" id="health-id" value="0"> 
                                <div class="form-group" >

                                <label class="radio-inline" style="margin-bottom: 1em;padding-left: 0;">Gender : &nbsp;</label>
                                <label class="radio-inline " style="margin-bottom: 1em;padding-left: 0;">
                                    <input type="radio" name="optionsRadioGenderLeft" id="optionsRadioMaleLeft" value="1" checked>Male
                                </label>
                                <label class="radio-inline" style="margin-bottom: 1em;">
                                    <input type="radio" name="optionsRadioGenderLeft" id="optionsRadioFemaleLeft" value="0">Female
                                </label>
                                    
                              </div>                              

                                <input id="entered-weight" type="text" name="student_weight" class="form-control" placeholder="Enter Weight in kg">
                                </div>
                                 <div class="form-group">   
                                <input id="entered-height" type="text" name="student_height" class="form-control" placeholder="Enter height in cm">
                                </div>
                                <button class="btn btn-primary" onclick="javascript:calculateBMI();">Caculate</button>

                                <br><br/><h4>Result:</h4>
                               <span class="radio-inline col-3-span"> BMI is : <label id="result-bmi" class="radio-inline"></label></span><br/>
                                <span class="radio-inline col-3-span"> Classified based of Age & Weight :</span><br> <label id="result-classified" class="radio-inline"></label><br/>
                               
                              </div>
                            </div> <!-- end bmi-->
                            
                        </div>
                        <div class="col-lg-9">
                             <form action="student-process.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="student-id" id="student-id" value="0">
                                <input type="hidden" name="account-id" id="account-id" value="0">
                                <input type="hidden" name="image_path" id="image-path" value="">                      
                             <div class="col-lg-6">
                                <div class="img-box">
                                  <img id="student-img" src="./images/noimage.png" style="text-align: center;border:1px solid #333;">
                                     <input type="file" name="image"  id="image" /> 
                                </div>
                                <br/>
                                <div class="form-group">                                   
                                    <input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name" required>                                       
                               </div>
                               <div class="form-group">                                   
                                <input  type="text" id="middlename" class="form-control" name="middlename" placeholder="Middle Name" required>                                       
                               </div>
                              <div class="form-group">                                   
                                <input  type="text" id="lastname" class="form-control" name="lastname" placeholder="Last Name" required>                                       
                             </div>
                              <div class="form-group" >
                                <label class="radio-inline" style="margin-bottom: 1em;">Gender : &nbsp;</label>
                                <label class="radio-inline" style="margin-bottom: 1em;">
                                    <input type="radio" name="optionsRadioGender" id="optionsRadioMale" value="1" checked>Male
                                </label>
                                <label class="radio-inline" style="margin-bottom: 1em;">
                                    <input type="radio" name="optionsRadioGender" id="optionsRadioFemale" value="0">Female
                                </label>
                                    
                              </div>
                               <div class="form-group">
                                <input type="text" name="student_height" class="form-control" placeholder="Height in cm">
                              </div>
                               <div class="form-group">
                                <input type="text" name="student_weight" class="form-control" placeholder="Weight in Kg">
                              </div>
                             
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                                <input  type="text" id="age" class="form-control" name="age" placeholder="Age (Month)" required>
                              </div>
                               <div class="form-group" style="width: 90%;">   
                                 <div id="datetimepicker" class="input-append date">  

                                 <input  type="text" id="birthday" class="form-control" name="birthday" placeholder="Birthday" required>  
                                 <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                  </span>
                                 </div>                                   
                                </div>

                             
                                <div class="form-group">                                   
                                    <input  type="text" id="citizenship" class="form-control" name="citizenship" placeholder="Citizenship" required>                                       
                                </div>
                                 <div class="form-group">                                   
                                    <input  type="text" id="religion" class="form-control" name="religion" placeholder="Religion" required>                                       
                                </div>
                                <!--
                                 <div class="form-group">                                   
                                    <input  type="text" id="classsection" class="form-control" name="classsection" placeholder="Class Section" required>                                       
                                </div>
                                -->
                                 <div class="form-group">  
                                  <select class="form-control" name="classsection">                                 
                                 <?php 

                                  $sql_section = "SELECT * FROM tbl_section";

                                  $result_section = mysqli_query($mysqli,$sql_section);

                                        if (mysqli_num_rows($result_section) > 0) {                                     

                                            while($row_section = mysqli_fetch_assoc($result_section)) {
                                              echo '<option value="'.$row_section['id'].'">'.$row_section['section'].'</option>';
                                            }
                                        }
                                     
                                 ?>
                                   </select>
                                 </div>

                                 <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="7"></textarea>
                                 </div>
                                  <div id="logincredential">                
                                    LOGIN CREDENTIAL : <br><br/>                              
                                  
                                    <div class="form-group">                                   
                                       <input  type="text" class="form-control" id="username" name="username" placeholder="Username" required>                                       
                                      </div>
                                     <div class="form-group">                                   
                                     <input  type="text" class="form-control" id="password" name="password" placeholder="Password" required>                                       
                                    </div>
                                  </div>
                               <div class="panel-body">
                                  <input id="btnSaveStudent" type="submit" name="submitSave"  class="btn btn-primary mybtn" value="SAVE" style="float:right; margin-right: 10px;">                          
                                
                                </div>           
                              
                            </div>
                        
                             </form>
                        </div>
                    </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            list of student and its health classification
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th>ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Age<br>(month)</th>
                                        <th>Birthday</th>
                                        <th>Citizenship</th>
                                        <th>Religion</th>
                                        <th>Address</th>
                                        <th>Class Section</th>
                                        <th>Image</th>                                       
                                        <th>Account ID</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT tbl_student.id,  `firstname` ,  `middlename` ,  `lastname` ,  `gender` ,  `age` ,  `birthday` ,  `citizenship` ,  `religion` ,  `address` ,  tbl_section.section tssection , `account_id` ,  `image_path` , username, password FROM  `tbl_student` INNER JOIN tbl_account ON tbl_student.account_id = tbl_account.id INNER JOIN tbl_section on tbl_student.class_section_id=tbl_section.id WHERE tbl_student.deleted =0";
                                    $result = mysqli_query($mysqli,$sql);

                                    if (mysqli_num_rows($result) > 0) {                                     

                                        while($row = mysqli_fetch_assoc($result)) {
                                          $gender="";
                                        if($row['gender']==1){
                                          $gender="Male";
                                        }else{
                                          $gender="Female";
                                        }
                                            echo '<tr onclick="javascript:showStudentModal(this);">';//showRowStudent
                                               echo '<td>'.$row['id'].'</td>';
                                              echo '<td>'.$row['firstname'].'</td>';
                                              echo '<td>'.$row['middlename'].'</td>';
                                              echo '<td>'.$row['lastname'].'</td>';
                                              echo '<td>'.$gender.'</td>';
                                              echo '<td>'.$row['age'].'</td>';   
                                              echo '<td>'.$row['birthday'].'</td>';                                              
                                              echo '<td>'.$row['citizenship'].'</td>';
                                              echo '<td>'.$row['religion'].'</td>';                                            
                                              echo '<td>'.$row['address'].'</td>';
                                              echo '<td>'.$row['tssection'].'</td>'; 
                                              echo '<td>'.$row['image_path'].'</td>';                                                                                             
                                              echo '<td>'.$row['account_id'].'</td>';   
                                              echo "</tr>";
                                        }
                                    }
                                  ?>                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->                       
                        </div>
                        <!-- /.panel-body --> 
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 </div>
  <!-- modal Student -->

        <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelStudent" aria-hidden="true" >
            <div class="modal-dialog" style="width:1080px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelStudent">Student Detail <span id="liquidationDate" style="color:orange;"></span></h4>                                                
                    </div>

                    <form id="myform" action="student-process.php" method="post" enctype="multipart/form-data" onsubmit="validateFormInput();" >

                        <div class="modal-body student-modal-body">

                             
                        </div><!--modal body -->
                        <div class="modal-footer">  
                            <input type="submit"   name="submitDelete" class="btn btn-danger" value="Delete">  

                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                                                                 
                             <input type="submit"   name="submitUpdate" class="btn btn-primary" value="Save">            
                        </div>
                   </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->
  <style type="text/css">
     .table thead tr th,.table tbody tr td{
    text-align: center;
  }
  .col-lg-3{
    border-right: 1px solid rgba(0,0,0,0.2);
    height: 600px;
    background: #f7f5f5;
  }
  .col-3-span{
    font-size: 12px;
    padding-left: 0 !important;
    margin-left: 0 !important;
  }
 
  </style>

 <script type="text/javascript">

   function calculateBMI(){
    var weight = document.getElementById('entered-weight').value;
    var height = document.getElementById('entered-height').value;
    var bmi = 0;
    var result =0;
   //  bmi = (weight / (height * height)* 703);
    height = height / 100;
     bmi = (weight / (height * height));
    result = bmi.toFixed(1);
    classify ="";
    /*
    if (result < 18.5){
      classify= "Underweight";
    }  
    else if(result >= 18.5 && result <= 25){
       classify = "Normal";
    }
    else if(result > 25 && result <= 30){
         classify = "overweight";
    }
    else if(result > 30){
        classify = "Obese";
    }
    document.getElementById('result-classified').innerHTML=classify;
    */

    document.getElementById('result-bmi').innerHTML=result;
    var age = document.getElementById('ageLeft').value;   
    var sex = 0; 

     if (document.getElementById('optionsRadioMaleLeft').checked) {
      sex = 1;
    }else{
      sex = 0;
    }
   

     $('#result-classified').load('new-child-class-calculator.php?age=' + age + '&sex=' + sex + '&weight=' + weight,function(){});
   }

   function ajaxBMI(type){
    var weight = document.getElementById('entered-weight').value;
    var height = document.getElementById('entered-height').value;
    var resultbmi =document.getElementById('result-bmi').innerHTML;
    var resultclassify = document.getElementById('result-classified').innerHTML;
    var healthId = document.getElementById('health-id').value;
    var studentid = document.getElementById('student-id').value;
    var type = type;

      $.ajax({
      type: 'post',
      url: 'studentHealthHistory-processajax.php',
      data: {
       type:type,
       weight: weight,
       height: height,
       resultbmi: resultbmi,
       resultclassify: resultclassify,
       healthId: healthId,
       studentid:studentid,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#showthis' ).html(response);
      }
      });
      cleardata();
   }
   function cleardata(){
      document.getElementById('entered-weight').value="";
      document.getElementById('entered-height').value="";
       document.getElementById('result-classified').innerHTML="";
       document.getElementById('result-bmi').innerHTML="";
       document.getElementById('health-id').value=0;
   }
  function showRow(row){
    
    document.getElementById('ajax-health-save').disabled=true;
      var x=row.cells;
      document.getElementById("health-id").value = x[0].innerHTML;
      document.getElementById("entered-weight").value = x[2].innerHTML;
      document.getElementById("entered-height").value = x[3].innerHTML;
      document.getElementById("result-bmi").innerHTML = x[4].innerHTML;
      document.getElementById("result-classified").innerHTML = x[5].innerHTML;
    
  }
  //update delete modal
   function showStudentModal(row){

        var x=row.cells;
         var id = document.getElementById("student-id").value = x[0].innerHTML;
        
        $('.student-modal-body').load('student-modal.php?id=' + id,function(){
             
            $('#studentModal').modal({show:true}); 
           
        });
                
    }

   function showRowStudent(row){

        var x=row.cells;
        document.getElementById("student-id").value = x[0].innerHTML;
        document.getElementById("firstname").value = x[1].innerHTML;
        document.getElementById("middlename").value = x[2].innerHTML;
        document.getElementById("lastname").value = x[3].innerHTML;

        radiobtnMale = document.getElementById("optionsRadioMale");
        radiobtnFeMale = document.getElementById("optionsRadioFemale");
        var gender = x[4].innerHTML;
        if(gender == 'Male'){
          
          radiobtnMale.checked = true;
          radiobtnFeMale.checked=false;
        }else if(gender == 'Female'){
      
          radiobtnMale.checked = false;
          radiobtnFeMale.checked=true;
        }      
        document.getElementById("age").value = x[5].innerHTML;
        document.getElementById("birthday").value = x[6].innerHTML;                
        document.getElementById("citizenship").value = x[7].innerHTML;
        document.getElementById("religion").value = x[8].innerHTML;                
        document.getElementById("address").value = x[9].innerHTML;
        document.getElementById("classsection").value = x[10].innerHTML;
         document.getElementById("image-path").value = x[11].innerHTML;          
        document.getElementById("account-id").value = x[12].innerHTML;

        var accountId =x[12].innerHTML;
        var studentid = x[0].innerHTML;
        var image =  x[11].innerHTML; 
        //set image 
        document.getElementById("student-img").src="./images/"+image;
        
        showCredential(accountId);
        showHealthHistory(studentid);
        btnenabled();
   }
    function showCredential(id){
      var accountid = id;
      $.ajax({
      type: 'post',
      url: 'ajaxlogincredential.php',
      data: {
       accountid:accountid,       
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#logincredential' ).html(response);
      }
      });
      
   }

   function showHealthHistory(studentidl){
    var studentid = studentidl;
    var select = 'show';
      $.ajax({
      type: 'post',
      url: 'studentHealthHistory-processajax.php',
      data: {
       select:select,
       studentid:studentid,       
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#showthis' ).html(response);
      }
      });
   }
   function btnenabled(){

    document.getElementById("ajax-health-edit").disabled = false;
    document.getElementById("ajax-health-save").disabled = false;
    document.getElementById("btnUpdateStudent").disabled = false;
    document.getElementById("btnDeleteStudent").disabled = false;
    document.getElementById("btnSaveStudent").disabled = true;
   }
  

 </script>

<?php
	include '../template/footer.php';
?>