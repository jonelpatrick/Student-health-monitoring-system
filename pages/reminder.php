<?php
	include '../template/header.php';
?>
<style type="text/css">
    .sm-width{ width: 5% ;}
    .md-width{ width: 10% ; }
    .xmd-width{ width: 15% ; }
    #noise{
        height: 300px;
        margin-bottom: 1em;
    }
    #editorXWidgEditor{
          height: 200px;
        margin-bottom: 1em;
    }

</style>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="glyphicon glyphicon-calendar"></i> Reminder</h1>
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
                        Create Reminder     
                    </div>


        <form action="reminder-process.php" value="true" method="post" enctype="multipart/form-data">

            <fieldset>
            <div class="panel panel-default" style="margin-top: 1em; height: 60px;">
                <label class="radio-inline" style="margin-top: 1em;">INSERT IMAGE : </label>
                <div class="radio-inline"  style="margin-top: 1em;">
                    <input type="file" name="image"  id="image" value="true"/>     
                </div>
                
            </div>
                 
                <textarea id="noise" name="remindertext" class="widgEditor nothing" style="width: 100%;" value="true" placeholder="Type your text here"></textarea>
            </fieldset>
            <fieldset class="submit" style="margin-bottom: 2em;">
                <input type="submit" name="submitReminder" value="SUBMIT REMINDER" class="btn btn-primary">
            </fieldset>
        </form>
  


                    </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Reminders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th class="sm-width">ID</th>
                                         <th class="md-width">Date Created</th>
                                        <th>Reminder</th>
                                        <th class="md-width">Image</th>                                        
                                        <th class="xmd-width">Created By</th>                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
	                                $sql = "SELECT tbl_reminder.id rid,tbl_reminder.date_created rdatecreated,tbl_reminder.reminder reminder,tbl_reminder.image_path rimage,tbl_admin.firstname afname,tbl_admin.middlename amname,tbl_admin.lastname alname FROM tbl_reminder INNER JOIN tbl_admin on tbl_reminder.user_id=tbl_admin.id WHERE tbl_admin.deleted = 0 ORDER BY tbl_reminder.id DESC";
	                                $result = mysqli_query($mysqli,$sql);

	                                if (mysqli_num_rows($result) > 0) {	                                    

	                                    while($row = mysqli_fetch_assoc($result)) {

                                        $name="".$row['afname']." ".$row['amname']." ".$row['alname'];                                        
	                                          echo '<tr onclick="javascript:showReminderModal(this);">';
                                              echo '<td>'.$row['rid'].'</td>';
	                                    	  echo '<td>'.$row['rdatecreated'].'</td>';
	                                    	  echo '<td>'.$row['reminder'].'</td>';
	                                    	  echo '<td>'.$row['rimage'].'</td>';
	                                    	  echo '<td>'.$name.'</td>';	                                    	  
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
        <div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelReminder" aria-hidden="true" >
            <div class="modal-dialog" style="width:1080px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelReminder">Reminder Post Detail <span id="liquidationDate" style="color:orange;"></span></h4>                                                
                    </div>

                    <form  action="reminder-process.php" method="post" enctype="multipart/form-data" >
                        <input type="hidden" id="reminderId" name="reminderId">
                        
                        <fieldset>
                        <div class="modal-body reminder-modal-body">
                             <div class="col-sm-3">
                                <div class="img-box">
                                  <img id="reminderImage" src="./images/noimage.png" style="text-align: center;border:1px solid #333;min-width:200px;min-height: 200px;">
                                     <input type="file" name="image"  id="image" /> 
                                </div>
                           </div>
                            <div class="col-sm-9">
                                <textarea id="editorXWidgEditor" name="reminderText" class="widgEditor nothing" style="width: 100%;" value="true" ></textarea>  
                            </div>
                             
                        </div><!--modal body -->
                         </fieldset>
                        <div class="modal-footer">  
                            <input type="submit"   name="submitReminderDelete" class="btn btn-danger" value="Delete">  

                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                                                                 
                             <input type="submit"   name="submitReminderUpdate" class="btn btn-primary" value="Save">            
                        </div>
                   </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->
 </div>
  <script type="text/javascript">

        function showReminderModal(row){

            var x=row.cells;
            var id = x[0].innerHTML;
            var reminder =x[2].innerHTML;
            var img =x[3].innerHTML;

            document.getElementById('reminderId').value=id;
            document.getElementById('editorXWidgEditor').value = reminder;
            document.getElementById("reminderImage").src="./images/" + img;
            
            $('#reminderModal').modal({show:true});         
        }

  </script>

<?php
	include '../template/footer.php';
?>