<?php
	include '../template/header.php';
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-sticky-note fa-fw"></i>Generated Report</h1>
                 <div class="row">
	                <div class="col-lg-12">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                         Generate Report 
	                    </div>
	                </div>
	                <div class="panel-body">
	                	FILTER RESULTS:<br/><br/>
	                	<div class="form-group radio-inline">   
	                         <div id="datetimepicker" class="input-append date">  
	                         <label class="radio-inline"><b>FROM: </b></label>	
	                         <input style="width: 70%;"  type="text" id="fromDate" class="form-control radio-inline" name="fromDate" placeholder="Select Date" required>  
	                         <span class="add-on">
	                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
	                          </span>
	                         </div>                                   
                        </div>
                         <div class="form-group radio-inline">   
	                         <div id="datetimepicker2" class="input-append date">  
	                         <label class="radio-inline"><b>TO: </b></label>	
	                         <input style="width: 75%;"  type="text" id="toDate" class="form-control radio-inline" name="toDate" placeholder="Select Date" required>  
	                         <span class="add-on">
	                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
	                          </span>
	                         </div>                                   
                        </div>
                         <div   class="form-group radio-inline">   
	                         <select id="healthClass" name="health-class">
	                         	<option value="all">All</option>
	                         	<option value="underweight">Underweight</option>
	                         	<option value="normal">Normal</option>
	                         	<option value="overweight">Overweight</option>
	                         	<option value="obese">Obese</option>
	                         </select>                              
                        </div>
	                	 <div class="form-group radio-inline">   
	                	 	<button class="btn btn-success" id="btnfilterResult" onclick="javascript:filterResult();"><i class="fa fa-filter"></i> FILTER</button>
	                	 </div>
	                	  <div class="form-group radio-inline">   
	                	 	<button class="btn btn-info" id="btnGeneratePDF" onclick="javascript:generateReport();" ><i class="fa fa-file-pdf-o"></i> Generate PDF</button>
	                	 </div>
	                </div>

	                  <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Results
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id="reportResult">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                             <thead>
                                    <tr>
                                     <th>ID</th>
                                     <th>Date of Check</th>
                                     <th>First Name</th>
                                     <th>Middle Name</th>
                                     <th>Last Name</th>
                                     <th>Age</th>
                                     <th>Gender</th>
                                     <th>Section</th>
                                     <th>Classification</th>
                                    </tr>
                             </thead>
                              <tbody>
                              <?php
	                                $sql = "SELECT tbl_health_profile.id hfid,tbl_health_profile.date_check_up hfdate,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname,tbl_student.age sage,tbl_student.gender sgender,tbl_section.section ssection,tbl_health_profile.classification hfclass FROM `tbl_health_profile` INNER JOIN tbl_student on tbl_health_profile.student_id=tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id";
	                                $result = mysqli_query($mysqli,$sql);
	                                if (mysqli_num_rows($result) > 0) {	                                    

	                                    while($row = mysqli_fetch_assoc($result)) {
                                        $gender="";
                                        if($row['sgender']==1){
                                          $gender="Male";
                                        }else{
                                          $gender="Female";
                                        }
	                                    	  echo '<tr>';
                                          	  echo '<td>'.$row['hfid'].'</td>';
	                                    	  echo '<td>'.$row['hfdate'].'</td>';
	                                    	  echo '<td>'.$row['sfname'].'</td>';
	                                    	  echo '<td>'.$row['smname'].'</td>';
	                                    	  echo '<td>'.$row['slname'].'</td>';
	                                    	  echo '<td>'.$row['sage'].'</td>';
	                                    	  echo '<td>'.$gender.'</td>';
	                                    	  echo '<td>'.$row['ssection'].'</td>';
	                                    	  echo '<td>'.$row['hfclass'].'</td>';	                                    	  
	                                    	  echo "</tr>";
	                                    }
	                                }
                                ?>    
                              </tbody>
                            </table>

                        </div>
                      </div>
	                	
	                </div><!-- /.col-lg-12 -->
	              </div>

		         </div>
            </div>
            
        </div>
 </div>
 <script type="text/javascript">
	 function generateReport(){
	 	var fromDate=document.getElementById('fromDate').value;
	 	var health=document.getElementById('healthClass').value;
	 	var toDate = document.getElementById('toDate').value;

	 	
 		var error=0;
 		//alert(fromDate+" "+toDate+" "+healthClass);
 		if(fromDate!=''){
 			if(toDate!=''){
 		
 				
 			}else{
 				
 				error=1;
 			}
 		}else if(toDate!=''){
 			if(fromDate!=''){
 		
 			}else{
 				
 				error=1;
 			}
 		}
 		if(error==0){
 			window.open('generate-pdf.php?health='+health+'&fromDate='+fromDate+'&toDate='+toDate);
 		}else{
 			alert('Filtering with Date is not complete, Please Check');
 		}	

	 	
	}

 	function filterResult(){
 		var fromDate = document.getElementById('fromDate').value;
 		var toDate = document.getElementById('toDate').value;
 		var healthClass = document.getElementById('healthClass').value;
 		var dateEmpty=0;
 		var error=0;
 		//alert(fromDate+" "+toDate+" "+healthClass);
 		if(fromDate!=''){
 			if(toDate!=''){
 				dateEmpty=1;
 				
 			}else{
 				
 				error=1;
 			}
 		}else if(toDate!=''){
 			if(fromDate!=''){
 				dateEmpty=1;
 			}else{
 				
 				error=1;
 			}
 		}else{
 			dateEmpty=0;
 		}
 		if(error==0){
 			 $.ajax({
	      type: 'post',
	      url: 'ajaxgeneratereport.php',
	      data: {
	       dateEmpty:dateEmpty,       
	       fromDate:fromDate,
	       toDate:toDate,
	       healthClass:healthClass,
	      },
	      success: function (response) {
	       // We get the element having id of display_info and put the response inside it
	       $( '#reportResult' ).html(response);
	      }
	      }); 		
 		}else{
 			alert('Filtering with Date is not complete, Please Check');
 		}	
	      	     
 	}
 </script>

<?php
	include '../template/footer.php';
?>
<!--SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up dfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_student.class_section ssection, tbl_health_profile.classification hfclass
FROM  `tbl_health_profile`
INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id WHERE tbl_health_profile.date_check_up BETWEEN '2018-04-10' AND '2018-04-11' 

SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up dfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_student.class_section ssection, tbl_health_profile.classification hfclass
FROM  `tbl_health_profile`
INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id WHERE tbl_health_profile.classification='Normal'
-->