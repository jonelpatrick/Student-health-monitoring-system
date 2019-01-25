<?php
	include '../template/header.php';
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-info-circle fa-fw"></i>DSWD</h1>
            </div>
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
                        DSWD Personal Detail        
                    </div>
                    <div class="panel-body">
                     <form action="administrator-process.php" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-3">
                            <div class="img-box">
                              <img id="student-img" src="./images/noimage.png" style="text-align: center;border:1px solid #333;">
                                 <input type="file" name="image"  id="image" /> 
                            </div>
                        </div>
                        <div class="col-lg-9">
                          
                             <input type="hidden" name="selectedId" id="selectedId" value="0"> 
                             <input type="hidden" name="account-id" id="account-id"> 
                             <div class="col-lg-6">
                                <div class="form-group">                                   
                                    <input  type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>                                       
                               </div>
                               <div class="form-group">                                   
                                <input  type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" required>                                       
                               </div>
                              <div class="form-group">                                   
                                <input  type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>                                       
                             </div>
                     		 <div class="form-group">
                                <label>Gender &nbsp;</label>
                               <label class="radio-inline">
	                                <input type="radio" name="optionsRadioGender" id="optionsRadioMale" value="1" checked>Male
	                            </label>
	                            <label class="radio-inline">
	                                <input type="radio" name="optionsRadioGender" id="optionsRadioFemale" value="0">Female
	                            </label>
                                   
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
                                 <input  type="text" class="form-control" id="age" name="age" placeholder="Age" required>                                       
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
      	            			
                             
                            </div>
                            <div class="col-lg-6">
                               <div class="form-group">                                   
                                    <input  type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Citizenship" required>                                       
                                </div>
                                 <div class="form-group">                                   
                                    <input  type="text" class="form-control" id="religion" name="religion" placeholder="Religion" required>                                       
                                </div>
                                 <div class="form-group">                                   
                                    <input  type="text" class="form-control" id="occupation" name="occupation" placeholder="Occupation" required>                                       
                                </div>
                                 <div class="form-group">
                                    <label>Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="14" required></textarea>
                                 </div>
                            </div>
                             <input id="btnsave" type="submit" name="submitSave"  class="btn btn-primary mybtn" value="SAVE" style="float:right; margin-right: 10px;">                          
                             <input id="btnupdate" type="submit" name="submitUpdate" class="btn btn-primary mybtn" value="UPDATE" style="float:right; margin-right: 10px;" disabled>
                             <input id="btndelete" type="submit" name="submitDelete" class="btn btn-warning mybtn" value="DELETE" style="float:right; margin-right: 10px;" disabled>
                                                   
                           
                            </form>

                        </div>
                    </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Manager
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
                                        <th>Birthday</th>
                                         <th>Age</th>
                                        <th>Citizenship</th>
                                        <th>Religion</th>
                                        <th>Occupation</th>
                                        <th>Address</th>
                                        <th>Account ID</th>
                                         <th>Image</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
	                                $sql = "SELECT tbl_admin.id aid, `firstname`, `middlename`, `lastname`, `age`, `gender`, `birthday`, `citizenship`, `religion`, `address`, `occupation`, `privilege`, `account_id`, `image_path`,username,password FROM tbl_admin inner join tbl_account on tbl_admin.account_id=tbl_account.id WHERE privilege='DSWD' AND tbl_admin.deleted=0 ORDER BY tbl_admin.id desc";
	                                $result = mysqli_query($mysqli,$sql);

	                                if (mysqli_num_rows($result) > 0) {	                                    

	                                    while($row = mysqli_fetch_assoc($result)) {
                                        $gender="";
                                        if($row['gender']==1){
                                          $gender="Male";
                                        }else{
                                          $gender="Female";
                                        }
	                                    	  echo '<tr onclick="javascript:showDSWDModal(this);">';
                                           echo '<td>'.$row['aid'].'</td>';
	                                    	  echo '<td>'.$row['firstname'].'</td>';
	                                    	  echo '<td>'.$row['middlename'].'</td>';
	                                    	  echo '<td>'.$row['lastname'].'</td>';
	                                    	  echo '<td>'.$gender.'</td>';
	                                    	  echo '<td>'.$row['birthday'].'</td>';
	                                    	  echo '<td>'.$row['age'].'</td>';
	                                    	  echo '<td>'.$row['citizenship'].'</td>';
	                                    	  echo '<td>'.$row['religion'].'</td>';
	                                    	  echo '<td>'.$row['occupation'].'</td>';
	                                    	  echo '<td>'.$row['address'].'</td>';
                                          echo '<td >'.$row['account_id'].'</td>'; 
                                           echo '<td >'.$row['image_path'].'</td>';                                           
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
        <div class="modal fade" id="dswdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDSWD" aria-hidden="true" >
            <div class="modal-dialog" style="width:1080px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelDSWD">DSWD Detail <span id="liquidationDate" style="color:orange;"></span></h4>                                                
                    </div>

                    <form id="myform" action="administrator-process.php" method="post" enctype="multipart/form-data" >
                       
                        <div class="modal-body dswd-modal-body">

                             
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
 </div>
  <script language="javascript" type="text/javascript">
            function showDSWDModal(row){

                var x=row.cells;
                 var id = x[0].innerHTML;
                
                $('.dswd-modal-body').load('administrator-modal.php?id=' + id,function(){
                     
                    $('#dswdModal').modal({show:true}); 
                   
                });
                        
            }

            function showRow(row)
            {

                var x=row.cells;
                document.getElementById("selectedId").value = x[0].innerHTML;
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
                
                document.getElementById("birthday").value = x[5].innerHTML;
                document.getElementById("age").value = x[6].innerHTML;
                document.getElementById("citizenship").value = x[7].innerHTML;
                document.getElementById("religion").value = x[8].innerHTML;
                document.getElementById("occupation").value = x[9].innerHTML;
                document.getElementById("address").value = x[10].innerHTML;
                document.getElementById("account-id").value = x[11].innerHTML;
                var image = x[12].innerHTML;
                var accountid = x[11].innerHTML;
                showCredential(accountid);
                btnenabled();
                 document.getElementById("student-img").src="./images/"+image;
             //   whenClicked();
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
            function btnCancel(){
                document.getElementById("selectedId").value = "";
                document.getElementById("firstname").value =  "";
                document.getElementById("middlename").value =  "";
                document.getElementById("lastname").value =  "";
               
                
                document.getElementById("birthday").value =  "";
                document.getElementById("age").value =  "";
                document.getElementById("citizenship").value =  "";
                document.getElementById("religion").value =  "";
                document.getElementById("occupation").value =  "";
                document.getElementById("address").value =  "";
                document.getElementById("username").value =  "";
                document.getElementById("password").value =  "";
                document.getElementById("account-id").value =  "";
            }
             function btnenabled(){
              
              document.getElementById("btnupdate").disabled = false;
              document.getElementById("btndelete").disabled = false;
              document.getElementById("btnsave").disabled = true;
             }
            function whenClicked(){
             
                document.getElementById("btnSave").style.display="none";
                document.getElementById("btnUpdate").style.visibility = "visible";
                document.getElementById("btnDelete").style.visibility = "visible";
                document.getElementById("btnCancel").style.visibility = "visible";
                document.getElementById("btnAddImage").style.visibility = "visible";
                document.getElementById("btnAddMap").style.visibility = "visible";
                document.getElementById("btnAddArticle").style.visibility = "visible";
                 document.getElementById("btnAddFeature").style.visibility = "visible";
            }
            
                       
        </script>

<?php
	include '../template/footer.php';
?>