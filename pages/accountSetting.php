<?php
  include '../template/header.php';

   $user_id = $_SESSION['login_id'];
   $privilege = $_SESSION['privilege'];
 

   if($privilege == "Student"){

     $sql = "SELECT account_id,username,password FROM tbl_student inner join tbl_account on tbl_student.account_id = tbl_account.id where tbl_student.id = '$user_id'";
   $result = mysqli_query($mysqli,$sql);

   if (mysqli_num_rows($result) > 0) {                                     
      while($row = mysqli_fetch_assoc($result)) {
        
        $username = $row['username'];
        $password = $row['password'];
        $account_id = $row['account_id'];
      }
    }
   }else{

       $sql = "SELECT account_id,username,password FROM tbl_admin inner join tbl_account on tbl_admin.account_id = tbl_account.id where tbl_admin.id = '$user_id'";
   $result = mysqli_query($mysqli,$sql);

   if (mysqli_num_rows($result) > 0) {                                     
      while($row = mysqli_fetch_assoc($result)) {
        
        $username = $row['username'];
        $password = $row['password'];
        $account_id = $row['account_id'];
      }
    }
   }
 
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-gear"></i> Account Settings</h1>
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
                        <strong>Transaction Fail</strong> Please check.
                    </div>  
            <?php    }else{ } }?>
        </div>
          <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                 <div class="col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update your account       
                    </div>
                    <div class="panel-body">
                   
                      <form action="accountSetting-process.php" method="POST" onsubmit="return validateForm();">
                        <div class="form-group">
                          <label> USERNAME</label>
                          
                          <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
                          <input id="username" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        </div>
                        <div class="form-group">
                          <label> PASSWORD</label>
                          <input id="password" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        </div>
                         <div class="form-group">
                          <label> CONFIRM PASSWORD</label>
                          <input id="confirmpassword" type="password" name="confirmpassword" class="form-control" placeholder="confirm your password if you want to update" required="">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="UPDATE ACCOUNT">
                      </form>
                    </div>
                    </div>
                 </div>
                </div>
                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 </div>
 <script type="text/javascript">

   function validateForm(){

    var confirmpassword = document.getElementById('confirmpassword').value;  
    var password = document.getElementById('password').value;

    if(password == confirmpassword){
        return true;
    }else{
      alert(" Password and Confirm Password is not equal.");
      return false;
    }
   }

 </script>
  

<?php
  include '../template/footer.php';
?>