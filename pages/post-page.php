<?php
    include '../template/header.php';
?>
<style type="text/css">
    .sm-width{ width: 5% ;}
    .md-width{ width: 10% ; }
    .xmd-width{ width: 15% ; }
    .l-width{ width: 20% ; }
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
                <h1 class="page-header"> <i class="glyphicon glyphicon-pencil"></i> Post Event/Program</h1>
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
                        Create Post     
                    </div>


        <form action="post-process.php" value="true" method="post" enctype="multipart/form-data">

            <fieldset>
            <div class="panel panel-default" style="margin-top: 1em; height: 60px;">
                <label class="radio-inline" style="margin-top: 1em;">INSERT IMAGE : </label>
                <div class="radio-inline"  style="margin-top: 1em;">
                    <input type="file" name="image"  id="image" value="true"/>     
                </div>
                
            </div>
            <div style="margin:0.5em 0;">
                 <input type="text" name="postTitle" class="form-control" placeholder="Type Post Title" required="">
            </div>
                
                <textarea id="noise" name="postText" class="widgEditor nothing" style="width: 100%;" value="true" placeholder="Type your Post here" required=""></textarea>
            </fieldset>
            <fieldset class="submit" style="margin-bottom: 2em;">
                <input type="submit" name="submitPost" value="SUBMIT POST" class="btn btn-primary">
            </fieldset>
        </form>
  


                    </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Post
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th class="sm-width">ID</th>
                                         <th class="md-width">Date Created</th>
                                        <th class="l-width">Title</th>
                                        <th>Description</th>
                                        <th class="sm-width">Image</th>                                        
                                        <th class="xmd-width">Created By</th>                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                    $sql = "SELECT tbl_post.id pid,tbl_post.date_created pdatecreated,tbl_post.title ptitle,tbl_post.description pdesc,tbl_post.image_path pimage,tbl_admin.firstname afname,tbl_admin.middlename amname,tbl_admin.lastname alname FROM tbl_post INNER JOIN tbl_admin on tbl_post.user_id=tbl_admin.id WHERE tbl_admin.deleted = 0 ORDER BY tbl_post.id DESC";
                                    $result = mysqli_query($mysqli,$sql);

                                    if (mysqli_num_rows($result) > 0) {                                     

                                        while($row = mysqli_fetch_assoc($result)) {

                                        $name="".$row['afname']." ".$row['amname']." ".$row['alname'];                                        
                                              echo '<tr onclick="javascript:showPostModal(this);">';
                                              echo '<td>'.$row['pid'].'</td>';
                                              echo '<td>'.$row['pdatecreated'].'</td>';
                                              echo '<td>'.$row['ptitle'].'</td>';
                                              echo '<td>'.$row['pdesc'].'</td>';
                                              echo '<td>'.$row['pimage'].'</td>';
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
        <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelPost" aria-hidden="true" >
            <div class="modal-dialog" style="width:1080px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelReminder">Post Detail </h4>                                                
                    </div>

                    <form  action="post-process.php" method="post" enctype="multipart/form-data" >
                        <input type="hidden" id="postId" name="postId">
                        
                        <fieldset>
                        <div class="modal-body post-modal-body">
                             <div class="col-sm-3">
                                <div class="img-box">
                                  <img id="postImage" src="./images/noimage.png" style="text-align: center;border:1px solid #333;min-width:200px;min-height: 200px;">
                                     <input type="file" name="image"  id="image" /> 
                                </div>
                           </div>
                            <div class="col-sm-9">
                             <div style="margin:0.5em 0;">
                                 <input id="posttitle" type="text" name="posttitle" class="form-control" placeholder="Type Post Title">
                            </div>
                                <textarea id="editorXWidgEditor" name="postText" class="widgEditor nothing" style="width: 100%;" value="true" ></textarea>  
                            </div>
                             
                        </div><!--modal body -->
                         </fieldset>
                        <div class="modal-footer">  
                            <input type="submit"   name="submitPostDelete" class="btn btn-danger" value="Delete">  

                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                                                                 
                             <input type="submit"   name="submitPostUpdate" class="btn btn-primary" value="Save">            
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

        function showPostModal(row){

            var x=row.cells;
            var id = x[0].innerHTML;
            var title =x[2].innerHTML;
            var Description =x[3].innerHTML;
            var img =x[4].innerHTML;

            document.getElementById('postId').value=id;
            document.getElementById('posttitle').value = title;
            document.getElementById('editorXWidgEditor').value = Description;
            document.getElementById("postImage").src="./images/" + img;

            
            $('#postModal').modal({show:true});         
        }

  </script>

<?php
    include '../template/footer.php';
?>