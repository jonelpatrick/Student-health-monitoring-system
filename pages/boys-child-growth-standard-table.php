<?php
	include '../template/header.php';
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-table"></i> Child Growth Standard [boys]</h1>
            </div>
            <?php
            if(isset($_SESSION['ERR'])){
              if($_SESSION['ERR'] == ''){
                  
                 echo ' <div class="alert alert-success alert-dismissible">';
                 echo ' <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                 echo ' <strong>Changes Successfully made</strong> ';
                 echo '</div>   ';
                $_SESSION['ERR'] = '';  

              }else{
                 echo ' <div class="alert alert-danger alert-dismissible">';
                 echo ' <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                 echo ' <strong>Something went wrong</strong> ';
                 echo '</div>   ';
              }
            }  
            ?>
          
        </div>
          <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-default" style="    margin-top: 1em;">
                    <div class="panel-heading">
                        Detail
                    </div>
                    <div class="panel-body"> 
                      <form method="POST" action="../cli/functions.php">
                        <input type="hidden" name="action" value="addGrowth">
                        <input type="hidden" name="sex" value="boys">
                        <div class="col-lg-12">
                          <div class="form-group ">                                   
                            <label>Please input the given fields: [*Age in months | Weight in kg]</label>
                          </div>   
                          <div class="form-group radio-inline myform">                                   
                            <input  type="text" class="form-control radio-inline" name="age" placeholder="Age (Months)" required>                                       
                            
                            <input  type="text" class="form-control radio-inline" name="severely_underweight" placeholder="Severely Underweight" required> 
                             <input  type="text" class="form-control radio-inline" name="underweight_from" placeholder="Underweight FR" required> 
                            <input  type="text" class="form-control radio-inline" name="underweight_to" placeholder="Underweight TO" required> 
                            <input  type="text" class="form-control radio-inline" name="normal_from" placeholder="Normal FR" required> 
                            <input  type="text" class="form-control radio-inline" name="normal_to" placeholder="Normal TO" required> 
                            <input  type="text" class="form-control radio-inline" name="overweight" placeholder="Overweight" required> 
                          </div> 

                          <div class="form-group mybtn">
                            <input type="submit" name="submit" value="Add to table" class="btn btn-primary">  
                          </div>                                    

                        </div>
                      </form>                                       

                    </div>
                </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Weight(kg) for Age of BOYS (Months)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>                                         
                                        <th>Age<br>(Months)</th>
                                        <th>Severely <br>Underweight<br>Exact/Below</th>
                                        <th>Underweight<br>From</th>
                                        <th>Underweight<br>To</th>
                                        <th>Normal<br>From</th>
                                        <th>Normal<br>To</th>
                                        <th>Overweight<br>Exact/Above</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $sql = "SELECT 
                                            id,
                                            age,
                                            severely_underweight,
                                            underweight_from,
                                            underweight_to,
                                            normal_from,
                                            normal_to,
                                            overweight
                                            FROM boys_growth_table ORDER BY age ASC";

                                    $result = mysqli_query($mysqli,$sql);

                                    if (mysqli_num_rows($result) > 0) {                                     

                                        while($row = mysqli_fetch_assoc($result)) {
                                          
                                            echo '<tr onclick="javascript:showGrowthModal('.$row['id'].');">';//showRowStudent
                                              
                                              echo '<td>'.$row['age'].'</td>';
                                              echo '<td>'.$row['severely_underweight'].'</td>';
                                              echo '<td>'.$row['underweight_from'].'</td>';
                                              echo '<td>'.$row['underweight_to'].'</td>';
                                              echo '<td>'.$row['normal_from'].'</td>';   
                                              echo '<td>'.$row['normal_to'].'</td>';                                     
                                              echo '<td>'.$row['overweight'].'</td>';                                                     
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
 </div>
  <!-- modal Student -->

        <div class="modal fade" id="growthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelStudent" aria-hidden="true" >
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelStudent">Row Detail </h4>                                                
                    </div>

                    <form action="../cli/functions.php" method="post" >
                    <input type="hidden" name="action" value="editGrowth">
                        <div class="modal-body growth-modal-body">

                             
                        </div><!--modal body -->
                        <div class="modal-footer">  
                            <input type="submit"   name="submit" class="btn btn-danger" value="Delete">  

                             <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                                                                 
                             <input type="submit"   name="submit" class="btn btn-primary" value="Save">            
                        </div>
                   </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->
<style type="text/css">
  .table thead tr th,.table tbody tr td{
    text-align: center;
  }
  .myform input{
    width:13.0%;
  }
  .mybtn input{
    margin-top: 1em;
    float: right;
  }
  .panel-body {
    padding: 25px;
  }
</style>
 <script type="text/javascript">

  function showGrowthModal(id){
     var id = id;
     var sex = 'boys';
      $('.growth-modal-body').load('growth-modal-body.php?id=' + id + '&sex=' + sex,function(){
           
          $('#growthModal').modal({show:true});            
      });              
  }
 
 

 </script>

<?php
	include '../template/footer.php';
?>