<?php
	include '../template/header.php';

   
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-gear fa-fw"></i> Class Section</h1>
                <?php
                  $user_id = $_SESSION['login_id'];

                     $sql = "SELECT * FROM tbl_menu WHERE parent_id = '$user_id'";
                    $result = mysqli_query($mysqli,$sql);
                    $menuDate = "";
                    $dateNow = date("Y-m-d");
                     if (mysqli_num_rows($result) > 0) {  
                          while($row = mysqli_fetch_assoc($result)) {
                            $menuDate = $row['date_chosen'];
                          } 

                        if($menuDate >= $dateNow){ ?>
                             <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>You are assigned by the admin to buy the menu for the date of <?php echo $menuDate; ?> please check the details on the menu plan.</strong> 
                            </div>
                    <?php }
                        
                    }else{
                        
                    }
                ?>
           
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
                        <strong>Transaction Fail</strong> Please Check the information.
                    </div>  
            <?php    }else{ } }?>
             <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       
                        
                    </div>
                    <div class="panel-body">
                         <div class="col-lg-4">
                            <form method="POST" action="class-section-process.php">
                                <div class="form-group">
                                    <label>Enter Class Section</label>
                                    <input id="section" type="text" name="section" class="form-control"> 
                                    <input id="sectionId" type="hidden" name="sectionId">                                   
                                </div>
                                <div class="form-group">
                                <input id="btnSectionSave" class="btn btn-primary" type="submit" name="submitSave" value="Save">    
                                <input id="btnSectionUpdate" class="btn btn-success" type="submit" name="submitUpdate" value="Update" disabled >                             
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                              <table width="100%" class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Section</th>
                                          <th>Action</th>
                                          
                                       </tr>  
                                  </thead>
                                  <tbody>
                                   <?php
                                    $sql = "SELECT * FROM tbl_section  ORDER BY id desc";
                                    $result = mysqli_query($mysqli,$sql);

                                    if (mysqli_num_rows($result) > 0) {                                     

                                        while($row = mysqli_fetch_assoc($result)) {
                                          echo '<tr onclick="javascript:editSection(this);">';
                                          echo '<td>'.$row['id'].'</td>';
                                          echo '<td>'.$row['section'].'</td>';
                                          echo '<td>'.'<button class="btn btn-danger" onclick = "javascript:deleteSection('.$row['id'].');" > Delete</button>'.'</td>';
                                          
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
             </div>
        </div>
</div>
<script type="text/javascript">

    function deleteSection(id){

        window.location.href = "class-section-process.php?id="+ id + "&action=delete";
    }
    function editSection(row){
        var x=row.cells;
        document.getElementById("sectionId").value = x[0].innerHTML;
        document.getElementById("section").value = x[1].innerHTML;
       
        document.getElementById("btnSectionUpdate").disabled = false;
        document.getElementById("btnSectionSave").disabled = true;
    }

</script>
<?php
    include '../template/footer.php';
?>
