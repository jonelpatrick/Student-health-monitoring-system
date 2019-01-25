<?php
	 require '../connection/dbconnect.php';
     include 'session.php';
   error_reporting(0);
   $name_User = $_SESSION['firstname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Health Monitoring System</title>


    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- jQuery UI -->
    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

     <!-- text editor 
    <style type="text/css" media="all">
        /*@import "../lib/css/info.css"; */
        @import "../lib/css/main.css";
        @import "../lib/css/widgEditor.css";
        #noiseWidgToolbarButtonImage{
            display: none;
        }
    </style>

    <script type="text/javascript" src="../lib/scripts/widgEditor.js"></script>

    Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

     <!-- date time picker-->
     <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">

     <style type="text/css">
         select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{
              min-height: 30px !important; 
              margin-bottom: 0;
            }
            .input-append .add-on, .input-prepend .add-on{
                min-height: 30px;
            }
            .navbar .nav>li{
                float: none;
            }
            .navbar .nav>li>a{
                text-shadow: none;
            }
            .navbar .btn, .navbar .btn-group{
                margin-top: 0;
            }
            .modal{
                width: auto;
                margin-left: -50%;
                background: transparent;
                border: none;
                box-shadow: none;
            }
            .modal-content{
                padding: 0 20px;
            }
            .sidebar{
                width: 237px;
            }

            .notif-text{
                 height: 60px;

                 white-space: nowrap;
                 overflow: hidden;
                 text-overflow: ellipsis;
                     padding: 0 1em;
                 border-bottom: 1px solid rgba(0,0,0,0.1);
                 color:#333;
            }
            .notif-number{
                background: #da4f49;
                color: #fff;
                padding: 8px 10px;
                border-radius: 50%;
            }
            .notify-me{
                text-decoration: none;
            }
            .text-muted{
                padding-right: 1em;
            }
            .notify-me:hover{
                background: #e8f3f7;
            }
            .notify-box{
                  padding-top: 1em;
            }

            .notify-box:hover{
                    background: #e8f3f7;
              
            }
            .navbar-brand{
                color:#dc4207 !important;
            }
            @media (min-width: 768px){
                #menuModal .modal-dialog{
                    width: 800px !important;
                    margin: 0px auto;
                }
            }

     </style>
    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mail.php" style="font-weight: 500;"> STUDENT HEALTH MONITORING SYSTEM </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                       
                 <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span id="notification-display">
                     <?php

                         $login_id = $_SESSION['login_id'];
                        $login_type = $_SESSION['privilege'];

                        $sql_count_notif = "SELECT COUNT(*) FROM tbl_notification WHERE user_id = '$login_id' AND status=0 AND user_type='$login_type' AND posted_by != '$login_id'";
                        $rs_notif =  mysqli_query($mysqli,$sql_count_notif);

                         $result_notif = mysqli_fetch_array($rs_notif);
                         $number_of_notif = $result_notif[0];

                        if($number_of_notif > 0){
                            echo '<span class="notif-number">'.$number_of_notif.'</span>';
                        }
                    ?>    
                    </span>                    
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div class="notify-box">
                                <?php                                    

                                 $sql = "SELECT tbl_notification.id nid,tbl_post.description pdesc,tbl_post.title ptitle,tbl_post.date_created pdate FROM tbl_notification INNER JOIN tbl_post ON tbl_notification.post_id=tbl_post.id WHERE tbl_notification.user_id = '$login_id' AND status=0 AND user_type='$login_type' AND posted_by != '$login_id'";
                                    $result = mysqli_query($mysqli,$sql);

                                    if (mysqli_num_rows($result) > 0) {                                     

                                        while($row = mysqli_fetch_assoc($result)) {
                                             echo '<span class="pull-right text-muted small" clearfix><i>'.$row['pdate'].'</i></span></a>';
                                            echo '<a class="notify-me" onclick="updateNotification('.$row['nid'].');"><div class="notif-text"><strong>'.$row['ptitle'].'</strong><br>';
                                            echo ''.$row['pdesc'].'</div><br/>';
                                           
                                        }
                                    }
                                ?>                                   
                                </div>
                            </a>
                        </li>
                       
                    </ul>
                    <!-- /.dropdown-alerts -->
              
                <!-- /.dropdown -->
                <li class="dropdown" style="background-color: #ADD8E6;">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                       <span><?php echo $name_User; ?></span> 
                       <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="accountSetting.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider" style="color:#333"></li>                        
                        <li><a href="logout-process.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu" style="width: 100%;">                     
                     
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard fa-fw"></i> Dashboard
                            </a>
                        </li>
                         <li>
                            <a href="myprofile.php"><i class="fa fa-slideshare"></i> My Profile</a>
                        </li>   

                        <?php if($_SESSION['privilege']=="CSSDO" || $_SESSION['privilege']=="Administrator" ) {?>

                        <li>
                            <a href="parent.php"><i class="fa fa-group fa-fw"></i> Parent</a>
                        </li>
                       
                         <li>
                            <a href="student.php"><i class="fa fa-mortar-board fa-fw"></i> Pupil</a>
                        </li>

                       <?php }?>

                        <?php if($_SESSION['privilege']=="Administrator" ) {?>

                        <li>
                            <a href="manager.php"><i class="fa fa-star fa-fw"></i> CSSDO</a>
                        </li>

                         <li>
                            <a href="administrator.php"><i class="fa fa-info-circle fa-fw"></i> DSWD</a>
                        </li>

                        <li>
                            <a href="school.php"><i class="fa fa-institution fa-fw"></i> School</a>
                        </li>

                        <li>
                            <a href="class-section.php"><i class="fa fa-gear fa-fw"></i> Class Section</a>
                        </li>           

                       <?php } ?>

                       <?php if($_SESSION['privilege'] != 'Student'){ ?>
                         <li>
                            <a href="menulist.php"><i class="fa fa-shopping-basket fa-fw"></i> Menu Plan</a>
                        </li>
                        <?php } ?>

                        <?php if($_SESSION['privilege']=="DSWD" || $_SESSION['privilege']=="Administrator" || $_SESSION['privilege']=="CSSDO" ){?>

                         <li>
                            <a href="generatereport.php"><i class="fa fa-sticky-note fa-fw"></i> Generate Report</a>
                        </li> 
                         <li>
                            <a href="post-page.php"><i class="glyphicon glyphicon-pencil"></i> POST</a>
                        </li>                
                         <li>
                            <a href="reminder.php"><i class="glyphicon glyphicon-calendar"></i> REMINDER</a>
                        </li> 
                           <!-- if system admin -->
                        <?php if( $_SESSION['privilege'] == 'Administrator' ){ ?>

                      
                        <li>
                            <a href="ingridient-marketplace.php"><i class="fa fa-shopping-cart"></i> Marketplace Preview</a>
                        </li>
                        <li>
                            <a href="ingridient-marketplace-setup.php"><i class="fa fa-gear fa-fw"></i> Marketplace Manage</a>
                        </li>                              
                            
                        <?php } ?>                 
                        <!-- if system admin -->
                        <li>
                            <a href="#" ><i class="fa fa-table"></i>  Child Growth Standard<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" style="width: 100%;" >
                                <li>
                                    <a href="boys-child-growth-standard-table.php">For Boys</a>
                                </li>
                                <li>
                                    <a href="girls-child-growth-standard-table.php">For Girls</a>
                                </li>                              
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <?php } ?>

                         <?php if($_SESSION['privilege']=="DSWD" ||  $_SESSION['privilege']=="CSSDO" || $_SESSION['privilege']=="Parent" ){ ?>  
                    
                        <li>
                            <a href="ingridient-marketplace.php"><i class="fa fa-shopping-cart"></i> Ingridient Marketplace</a>
                        </li> 
                        <?php } ?>

                     

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

<script type="text/javascript">
    function updateNotification(idl){
         var id = idl;
        $.ajax({
        type: 'post',
        url: 'notify-me.php',
        data: {
         id:id,       
        },
        success: function (response) {
        
          $( '#notification-display' ).html(response);
           location.reload();
        }
        });     
        
    }

</script>

