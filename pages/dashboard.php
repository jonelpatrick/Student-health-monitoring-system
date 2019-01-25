<?php
    include '../template/header.php';

?>
<style type="text/css">
    .align-right{
        display: flex;
         justify-content: flex-end;
         font-size: 12px;
    }
    .avatar-sub-heading{
      font-size: 12px;  
      color: #aba8a8; 
    }
    .remind-active{
        background: #da4f49 !important;
        color: #fff !important;
    }
    .avatar{
        width: 60px;
        height: 60px;
    }
    .post-img{
        border-radius: 4px;
        box-shadow: 0px 2px 5px;
    }
    .avatar-name{font-size: 20px;color: #4c4b4b;}
    .side-bar{
           margin-top: 2em;
        border-left: 1px solid rgba(0,0,0,0.2);

    }
    .avatar-comment{
         width: 40px;
        height: 40px;
        opacity: 0.6;
       

    }
    .avatar-container{
         padding: 5px;
    }
    .panel-comment{
        margin-top: 1em;
        background: #f7f7f7;
        padding: 0.2em 0em;
        border: 0.5px solid rgba(55,55,55,0.1);
    }
    .comment-btn{
           display: flex;
        justify-content: flex-end;
        float: right;
            padding: 5px;
        margin-left: 0 !important;

        margin-top: 5px !important;
    }
    .comment-box{
        width: 77%; 
         margin-left: 0 !important;
        padding-left: 0 !important;
    }
    .comment-avatar{
            padding: 5px !important;
    }
    .comment-section-btn{
        width: 100%;
        background: transparent;
        box-shadow: none;
        /* border: none; */
        margin: 0.5em 0;
        padding-bottom: 0.5em;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        color: #194b75;
    }
    .comment-section-btn:hover{
        color:#da4f49;
    }
    .mycol-2{
        width:11%;
    }
    .mycol-3{
        width:86%;
        background: #fff;
        padding-bottom: 1em; 
        padding-right: 1em;  
    }
    .mycol-3 textarea{
        width: 100%;
        height: 90px;
    }
    .comment-date{
        font-size: 12px;
    }
    .comment-section-link{
          background: transparent;
        box-shadow: none;
        /* border: none; */
        margin: 0.5em 0;
        padding-bottom: 0.5em;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        color: #194b75;
    }
     .comment-section-link:hover{
        color:#da4f49;
    }
</style>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-dashboard fa-fw"></i> Dashboard</h1>
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
            <div id="aw"></div>
             <div class="row">
                <div class="col-lg-12" style="background: #e8e8e8;">
                       <!--
                        <div class="panel-heading">
                            Do you know what your BMI is ?
                        </div>
                        <div class="panel-body">
                        <img src="../upload/Screenshot_1.png" style="width:100%">
                        </div>
                        -->
                        <div class="col-lg-9" >
                            <div class="panel panel-default">
                               
                            </div>
                             <?php
                                    $sql = "SELECT tbl_post.id pid,tbl_post.date_created pdatecreated,tbl_post.title ptitle,tbl_post.description pdesc,tbl_post.image_path pimage,tbl_admin.firstname afname,tbl_admin.middlename amname,tbl_admin.lastname alname,tbl_admin.privilege aprivilege,tbl_admin.image_path aimage FROM tbl_post INNER JOIN tbl_admin on tbl_post.user_id=tbl_admin.id WHERE tbl_admin.deleted = 0 ORDER BY tbl_post.id DESC";
                                    $result = mysqli_query($mysqli,$sql);

                                    if (mysqli_num_rows($result) > 0) {                                     

                                        while($row = mysqli_fetch_assoc($result)) {

                                        $name="".$row['afname']." ".$row['amname']." ".$row['alname'];
                                        $postId = $row['pid'];
                            ?>                                                                                     
                                            <div class="panel panel-default">
                                                <!-- avatar heading -->
                                                <div class="panel-heading">
                                                    <div class="radio-inline">
                                                        <img src="./images/<?php echo $row["aimage"]; ?>" class="avatar" />
                                                    </div>
                                                    <div class="radio-inline">
                                                        <?php 
                                                            echo '<span class="avatar-name">'.$name.'</span><br>';
                                                            echo '<i class="avatar-sub-heading">'.$row['aprivilege'].'</i>';
                                                        ?>
                                                    </div>
                                                </div>
                                                <!-- avatar heading -->

                                                 <div class="panel-body">
                                                    <!-- post image -->
                                                     <div class="col-sm-4">
                                                          <img src="./images/<?php echo $row["pimage"]; ?>" class="post-img" />
                                                     </div>
                                                     <!-- post image -->
                                                    
                                                     <div class="col-sm-8">
                                                         <div class="col-sm-12">
                                                         <h3>
                                                         <?php 
                                                            echo $row['ptitle'];
                                                         ?>
                                                         </h3>

                                                         </div>
                                                          <!-- post description -->
                                                         <div class="col-sm-12">
                                                         <?php 
                                                            echo $row['pdesc'];
                                                         ?>
                                                         <br><br>
                                                           <?php  echo '<i class="avatar-sub-heading">Post Created: '.$row['pdatecreated'].'</i>'; ?>
                                                         </div>
                                                          <!-- post description -->

                                                          <!-- post comment -->                                                         
                                                          <div class="col-sm-12">
                                                            
                                                              <div class="panel-comment">
                                                                  <div class="radio-inline comment-avatar">
                                                                        <img src="./images/<?php echo $_SESSION['image']; ?>" class="avatar-comment" />
                                                                    </div>
                                                                    <div class="radio-inline comment-box">
                                                                       <input id="inputComment<?php echo  $postId; ?>" type="text" name="comment" class="form-control" placeholder="Type your comment here">
                                                                    </div>
                                                                     <div class="radio-inline comment-btn">
                                                                       <button class="btn btn-primary " onclick="insertComment(<?php echo $row['pid']; ?>);"><i class="fa fa-comments"></i></button>
                                                                    </div>
                                                              </div>
                                                            
                                                          </div>
                                                          <!-- post comment -->                                                    
                                                     </div>
                                                       <!-- comment section -->
                                                       <?php
                                                       $sqlcount = "SELECT COUNT(*) FROM tbl_comment WHERE post_id = '$postId'";
                                                        $rs =  mysqli_query($mysqli,$sqlcount);

                                                         $result2 = mysqli_fetch_array($rs);
                                                         $noOfComment = $result2[0];
                                                         
                                                       ?>
                                                        <div class="col-sm-12">
                                                            <div class="panel panel-default" style="background: #f5f5f5;">
                                                                <div id="commentSection<?php echo $postId; ?>">
                                                                <button onclick="showAllComment(<?php echo $postId; ?>);" class="comment-section-btn">view all comment  <i class="fa fa-comments"> <?php echo $noOfComment; ?></i></button><br/>
                                                                    <div id="commentInner<?php echo $postId; ?>">
                                                                        
                                                                    </div>
                                                                </div>      
                                                            </div>                                              
                                                        </div>
                                                      <!-- comment section -->

                                                 </div>
                                            </div>
                                          
                                <?php

                                        }
                                    }
                                ?>                                    

                        </div>
                        <div class="col-lg-3 side-bar">
                            <div class="panel panel-default">   
                            <?php
                            $isremind = 0;
                                $sql = "SELECT * FROM tbl_reminder";
                                $result = mysqli_query($mysqli,$sql);
                                  if (mysqli_num_rows($result) > 0) {   
                                    $isremind = 1;
                                  }
                            ?>                         
                                <div class="panel-heading <?php if($isremind>0){ echo " remind-active";} ?>">
                                    REMINDERS
                                    <i class="glyphicon glyphicon-calendar pull-right"></i>
                                </div>
                                <?php
                                    $sql = "SELECT * FROM tbl_reminder";
                                    $result = mysqli_query($mysqli,$sql);
                                      if (mysqli_num_rows($result) > 0) {                                       

                                        while($row = mysqli_fetch_assoc($result)) {
                                                                        
                                ?>
                                        <div class="panel-body">
                                            <div class="panel">
                                              <?php

                                                if($row['image_path']!='noimage.png'){
                                                    echo '<img src="./images/'.$row['image_path'].'">';
                                                     echo "<br><br>";
                                                }
                                               
                                                echo $row['reminder'];
                                                echo "<br/><br>";
                                                echo '<span class="align-right"><i>'.$row['date_created'].'</i><span>';
                                              ?>  
                                            </div>
                                        </div>
                                <?php
                                            }
                                        }else{
                                            echo "No Reminders";
                                        }
                                ?>
                            </div>
                        </div>
                   
                </div>
            </div>
             </div>
        </div>
</div>

<!--Modal area -->

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelConfirm" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelConfirm">Are you sure you want to delete this comment?</h4>                                                
                    </div>
                    <form action="comment-process.php" method="post" >
                       <input type="hidden" id="commentId" name="commentId">
                        <div class="modal-body confirm-modal-body">
                        <p>Please confirm your delete action.</p>  
                        </div><!--modal body -->
                        <div class="modal-footer">  
                            <input type="submit"  name="submitDelete" class="btn btn-danger" value="Delete Comment">  
                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>          
                        </div>
                   </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->

      <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelConfirm" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelConfirm">EDIT your comment</h4>                                                
                    </div>
                    <form action="comment-process.php" method="post" >
                       <input type="hidden" id="editCommentId" name="commentId">
                        <div class="modal-body edit-comment-modal-body">
                            <textarea id="comment-edit-modal" name="comment-edit-modal" style="width: 100%;">
                                
                            </textarea>
                        </div><!--modal body -->
                        <div class="modal-footer">  
                            <input type="submit"  name="submitEdit" class="btn btn-primary" value="EDIT Comment">  
                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>          
                        </div>
                   </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->

<script type="text/javascript">
    function insertComment(postId){

        var postId = postId;
        var xcomment = document.getElementById("inputComment"+postId).value;                
        var mode = "insert";

         $.ajax({
          type: 'post',
          url: 'comment-process.php',
          data: {
           postId:postId,
           xcomment:xcomment,       
           mode:mode,
          },
          success: function (response) {
           // We get the element having id of display_info and put the response inside it
           $( '#commentSection'+postId).html(response);
           $('#inputComment'+postId).val("");
          }
          });
        
    }
    function showAllComment(postId){


         var postId = postId;    

         $.ajax({
          type: 'post',
          url: 'comment-inner-process.php',
          data: {
           postId:postId,          
          },
          success: function (response) {
           // We get the element having id of display_info and put the response inside it
           $( '#commentInner'+postId).html(response);
            
          }
          });

    }
     function showConfirmDelete(idl){

        var id = idl;
        document.getElementById('commentId').value = id;

        $('#confirmDeleteModal').modal({show:true});           
                    
        }
    function showEditComment(idl){

    var id = idl;
    var comment = document.getElementById('comment-text'+idl).innerHTML;

    document.getElementById('editCommentId').value = id;
    document.getElementById('comment-edit-modal').value = comment;

    $('#editCommentModal').modal({show:true});           
                
    }
</script>
<?php
    include '../template/footer.php';
?>