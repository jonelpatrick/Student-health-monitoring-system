<?php
	include '../template/header.php';
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-institution fa-fw"></i>School</h1>
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
            <div class="col-lg-12">
               <div class="panel panel-default">
                    <div class="panel-heading">
                       School Detail      
                    </div>
                    <div class="panel-body">
                    <?php
                     $sql = "SELECT * FROM tbl_school";
                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) {	   
                  		 while($row = mysqli_fetch_assoc($result)) {
                  		 	$id = $row['id'];
                  		 	$school_name=$row['school_name'];
                  		 	$address = $row['address'];
                  		 	$image_path = $row['image_path'];
                  		 }
                      }
                      
                    ?>
                    	<form action="school-process.php" method="POST" enctype="multipart/form-data">
                    		<div class="col-lg-3">
	                            <div class="img-box">
	                              <img id="student-img" src="./images/<?php echo $image_path; ?>" style="text-align: center;border:1px solid #333;">
	                                 <input type="file" name="image"  id="image" /> 
	                            </div>
	                        </div>
	                        <div class="col-lg-9">
	                        <input type="hidden" name="id" value="<?php echo $id; ?>">
	                        	 <div class="form-group">                                   
                                    <input  type="text" class="form-control" id="school-name" name="school-name" placeholder="School Name" value="<?php echo $school_name; ?>"  required>                                       
                               </div>
                                 <div class="form-group">
                                    <label>School Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="14" required>
                                    	<?php echo $address; ?>
                                    </textarea>
                                 </div>
                                   <input id="btnupdate" type="submit" name="submitUpdate" class="btn btn-primary mybtn" value="UPDATE" style="float:right; margin-right: 10px;">
	                        </div>
                    	</form>
                    </div>
                 </div>
            	
            </div>
        </div>

 </div>

<?php
	include '../template/footer.php';
?>