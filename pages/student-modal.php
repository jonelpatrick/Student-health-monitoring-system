<?php
require '../connection/dbconnect.php';

if(!empty($_GET['id'])){

	$selectedId = $_GET['id'];
	 $username ="";
	 $password = "";
	 $account_id ="";
	 $sql_student = "SELECT firstname,middlename,lastname,gender,age,birthday,citizenship,religion,address,class_section_id,account_id,image_path,student_height,student_weight FROM tbl_student INNER JOIN tbl_section on tbl_student.class_section_id = tbl_section.id WHERE tbl_student.id = '$selectedId' AND deleted=0";

    $result_student = mysqli_query($mysqli,$sql_student);

    if (mysqli_num_rows($result_student) > 0) {     

        while($row = mysqli_fetch_assoc($result_student)) {

            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $gender = $row['gender'];
            $age = $row['age'];
            $birthday = $row['birthday'];
            $citizenship = $row['citizenship'];
            $religion = $row['religion'];
            $address = $row['address'];
            $class_section_id = $row['class_section_id'];
            $account_id = $row['account_id'];
            $image_path = $row['image_path'];     
            $heightl = $row['student_height'];       
            $weightl = $row['student_weight'];
                        
        }
    }

    $sql_account = "SELECT * FROM tbl_account WHERE id = '$account_id'";
	$result_account = mysqli_query($mysqli,$sql_account);

    if (mysqli_num_rows($result_account) > 0) {   

    	  while($row2 = mysqli_fetch_assoc($result_account)) {
    	  	$id = $row2['id'];
    	  	$username = $row2['username'];
    	  	$password = $row2['password'];
    	  }
    }  
}
?>
<div class="col-lg-12">
  
   <input type="hidden" name="student-id" id="student-id2" value="<?php echo $selectedId ; ?>">
    <input type="hidden" name="account-id" id="account-id2" value="<?php echo $account_id; ?>">
    <input type="hidden" name="image_path" id="image-path2" value="<?php echo $image_path; ?>">  
	<div class="col-lg-3">
	    <div class="img-box">
          <img src="./images/<?php echo $image_path; ?>" style="text-align: center;border:1px solid #333;">
             <input type="file" name="image"  /> 
        </div>
        <br/>
         <div class="form-group">                                   
	            <input value="<?php echo $firstname; ?>" type="text" class="form-control" name="firstname" placeholder="First Name" required>                                       
	       </div>
	       <div class="form-group">                                   
	        <input  type="text" value="<?php echo $middlename; ?>" class="form-control" name="middlename" placeholder="Middle Name" required>                                       
	       </div>
	      <div class="form-group">                                   
	        <input  type="text" value="<?php echo $lastname; ?>" class="form-control" name="lastname" placeholder="Last Name" required>                                       
	     </div>
	      <div class="form-group" >
            <label  style="margin-bottom: 1em;">Gender : &nbsp;<br/></label>
            <label class="radio-inline" style="margin-bottom: 1em;">
            <?php 
            	$radioMale ='';
            	$radioFemale = '';
             if($gender == 1){
		          	$radioMale = 'checked';
		          	$radioFemale = '';
	          
		        }else if($gender == 0){
		      
		      		$radioMale = '';
	          		$radioFemale = 'checked';
		        }    
            ?>
                <input id="optionModalMale" type="radio" name="optionsRadioGender"  value="1" <?php echo $radioMale; ?> >Male
            </label>
            <label class="radio-inline" style="margin-bottom: 1em;">
                <input  id="optionModalFemale" type="radio" name="optionsRadioGender" value="0" <?php echo $radioFemale; ?> >Female
            </label>
                
          </div>
         
            <div id="logincredential2">                
                LOGIN CREDENTIAL : <br><br/>                              
              
                <div class="form-group">                                   
                   <input  type="text" class="form-control"  name="username" placeholder="Username" value="<?php echo $username; ?>" required>                                       
                  </div>
                 <div class="form-group">                                   
                 <input  type="text" class="form-control"  name="password" placeholder="Password" value="<?php echo $password; ?>" required>                                       
                </div>
              </div>

	</div>
	<div class="col-lg-3">
		 <div class="form-group">
            <input id="ageModal"  type="text" value="<?php echo $age; ?>" class="form-control" name="age" placeholder="Age" required>
          </div>
           <div class="form-group" style="width: 90%;">   
             <div id="datetimepicker4" class="input-append date">  

             <input  type="text" value="<?php echo $birthday; ?>"  class="form-control" name="birthday" placeholder="Birthday" required>  
             <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
              </span>
             </div>                                   
            </div>

         
            <div class="form-group">                                   
                <input  type="text" value="<?php echo $citizenship; ?>" class="form-control" name="citizenship" placeholder="Citizenship" required>                                       
            </div>
             <div class="form-group">                                   
                <input  type="text" value="<?php echo $religion; ?>" class="form-control" name="religion" placeholder="Religion" required>                                       
            </div>
               <div class="form-group">  
                  <select class="form-control" name="classsection">                                 
                 <?php 

                  $sql_section = "SELECT * FROM tbl_section";

                  $result_section = mysqli_query($mysqli,$sql_section);
                  $selected = "";
                        if (mysqli_num_rows($result_section) > 0) {                                     

                            while($row_section = mysqli_fetch_assoc($result_section)) {

                            	$sectionidl = $row_section['id'];

                            	if($class_section_id == $sectionidl){

                            		$selected = "selected";
                            	}else{
                            		$selected = "";
                            	}

                              echo '<option value="'.$row_section['id'].'" '.$selected.'>'.$row_section['section'].'</option>';
                            }
                        }
                     
                 ?>
                   </select>
                 </div>
             <div class="form-group">
                <label>Address</label>
                <textarea name="address"  class="form-control" rows="7"><?php echo $address; ?></textarea>
             </div>
              <div class="form-group">
	          	<input type="text" name="student_height" placeholder="Height" placeholder="Height in cm" value="<?php echo $heightl; ?>">
	          </div>
	          <div class="form-group">
	          	<input type="text" name="student_weight" placeholder="Weight" placeholder="Weight in kg" value="<?php echo $weightl; ?>">
	          </div>

	</div>
	
	<div class="col-lg-3">
		 <div id="showthis2" style="height:350px;overflow:auto;  ">
           <table width="100%" class="table table-striped table-bordered table-hover">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Date</th>
                      <th>Weight</th>
                      <th>Height</th>
                      <th>BMI</th>
                      <th>Class</th>
                   </tr>  
              </thead>
              <tbody>
               <?php
                $sql = "SELECT * FROM tbl_health_profile where student_id='$selectedId' ORDER BY id desc";
                $result = mysqli_query($mysqli,$sql);

                if (mysqli_num_rows($result) > 0) {                                     

                    while($row = mysqli_fetch_assoc($result)) {
                      echo '<tr onclick="javascript:showRow2(this);">';
                      echo '<td>'.$row['id'].'</td>';
                      echo '<td>'.$row['date_check_up'].'</td>';
                      echo '<td>'.$row['weight'].'</td>';
                      echo '<td>'.$row['height'].'</td>';
                      echo '<td>'.$row['bmi'].'</td>';
                      echo '<td>'.$row['classification'].'</td>';
                      echo '</tr>';
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
	</div>
	<div class="col-lg-3">
	        <!--BMIcalc -->
            <div class="panel panel-default">
              <div class="panel-heading">
                Calculate BMI Here.
              </div>
              <div class="panel-body">
               <div class="form-group">  

               <input type="hidden" name="health-id" id="health-id2" value="0">   
                                           
                <input id="entered-weight2" type="text" name="weight" class="form-control" placeholder="Enter Weight in kg">
                </div>
                 <div class="form-group">   
                <input id="entered-height2" type="text" name="height" class="form-control" placeholder="Enter height in cm">
                </div>
               <!-- <button class="btn btn-primary" onclick="javascript:calculateBMI2();">Caculate</button> -->
                <span class="btn btn-primary" id="btnCalculateBMI">Caculate</span>
                <br><br/><h4>Result:</h4>
                 <span class="radio-inline col-3-span"> BMI is : <label id="result-bmi2" class="radio-inline"></label></span><br/>
                <span class="radio-inline col-3-span"> Classified based of Age & Weight :</span><br> <label id="result-classified2" class="radio-inline"></label><br/>
                <br>
                <!-- <button id="ajax-health-save2" class="btn btn-primary" onclick="javascript:ajaxBMI('save');" disabled>Save</button> -->
                 <span class="btn btn-primary" id="ajax-health-save2">Save</span>
                
               <!--  <button id="ajax-health-edit2" class="btn btn-primary" onclick="javascript:ajaxBMI('edit');" disabled>Edit</button> -->
              </div>
              
            </div> <!-- end bmi-->
	</div>

</div>

      <!--date time picker -->
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
    <!-- Date time picker -->

    <script>
    $(document).ready(function() {
    	$( "#btnCalculateBMI" ).click(function() {
		 	 calculateBMI2();
		});

		$( "#ajax-health-save2" ).click(function() {
		// 	ajaxBMI('save');
		 	//document.getElementById("health-id2").value;
		 	var x = $('#health-id2').val();

		 	if(x != 0){

		 		ajaxBMI2('edit');

		 	}else if(x == 0){

				ajaxBMI2('save');
		 	}
		 	
		});
		
	 });	
     function ajaxBMI2(type){
	    var weight = document.getElementById('entered-weight2').value;
	    var height = document.getElementById('entered-height2').value;
	    var resultbmi =document.getElementById('result-bmi2').innerHTML;
	    var resultclassify = document.getElementById('result-classified2').innerHTML;
	    var healthId = document.getElementById('health-id2').value;
	    var studentid = document.getElementById('student-id2').value;
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
	       $( '#showthis2' ).html(response);
	      }
	      });
	      cleardata2();
	   }
	    function cleardata2(){
		      document.getElementById('entered-weight2').value="";
		      document.getElementById('entered-height2').value="";
		       document.getElementById('result-classified2').innerHTML="";
		       document.getElementById('result-bmi2').innerHTML="";
		       document.getElementById('health-id2').value=0;
		   }
    $(document).ready(function() {
    
            $('#datetimepicker4').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
        });
          // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    
    });
/* previous function for bmi2
    function calculateBMI2(){
    var weight = document.getElementById('entered-weight2').value;
    var height = document.getElementById('entered-height2').value;
    var bmi = 0;
    var result =0;
  //  bmi = (weight / (height * height)* 703);
    height = height / 100;
     bmi = (weight / (height * height));
    result = bmi.toFixed(1);

    classify ="";
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
    document.getElementById('result-classified2').innerHTML=classify;
    document.getElementById('result-bmi2').innerHTML=result;

   }
*/
   function calculateBMI2(){

    var weight = document.getElementById('entered-weight2').value;
    var height = document.getElementById('entered-height2').value;
    var bmi = 0;
    var result =0;
   //  bmi = (weight / (height * height)* 703);
    height = height / 100;
     bmi = (weight / (height * height));
    result = bmi.toFixed(1);
    classify ="";
   
    document.getElementById('result-bmi2').innerHTML=result;
    var age = document.getElementById('ageModal').value;   
    var sex = 0; 

     if (document.getElementById('optionModalMale').checked) {
      sex = 1;
    }else{
      sex = 0;
    }
   

     $('#result-classified2').load('new-child-class-calculator.php?age=' + age + '&sex=' + sex + '&weight=' + weight,function(){});
   }

    function showRow2(row){    

      var x=row.cells;
      document.getElementById("health-id2").value = x[0].innerHTML;
      document.getElementById("entered-weight2").value = x[2].innerHTML;
      document.getElementById("entered-height2").value = x[3].innerHTML;
      document.getElementById("result-bmi2").innerHTML = x[4].innerHTML;
      document.getElementById("result-classified2").innerHTML = x[5].innerHTML;
    
  }
 
</script>