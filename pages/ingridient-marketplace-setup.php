<?php
  include '../template/header.php';
?>
<style type="text/css">
	div.dataTables_length label{
		padding-left: 10px;
	}
	div.dataTables_info{
		padding-left: 10px;	
	}
	.modal.fade.in{
		top: 4%;
	}
	table tr{
		    cursor: pointer;
	}
</style>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-shopping-cart"></i> Ingridient Marketplace - <small>Manage</small></h1>
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
                        Details      
                    </div>
                    <div class="panel-body">
                      
                        <form action="api-ingridient-marketplace-setup.php" method="POST" >
                            
                        
                        <div class="col-lg-12">
                           <hr/>

                            <div class="col-lg-10 col-lg-offset-1">

                            <b> >> Add Ingridient to Marketplace</b><br><br>
                            <div class="form-group">                                   
                                <input  type="text" class="form-control" id="ing_name" name="ing_name" placeholder="Ingridient Name" required>                                       
                        	</div>

                            <div class="form-group">                                   
                                <input  type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name : if none type [No Brand]" required>                                       
                            </div>

                            <div class="form-group">                                   
                                <input  type="Number" class="form-control" id="price" name="price"  min="0" step=".01" placeholder="Price [Must be proportional to the unit]" required>                                       
                             </div>

                            <div class="form-group">                                   
                             	<input  type="text" class="form-control" id="ing_unit" name="unit" placeholder="Unit ex. 250 kg, kg, gm, pc" required>                                       
                            </div>

                            <div class="form-group">                                   
                             	<input  type="text" class="form-control" id="ing_category" name="category" placeholder="Category ex. Fish, Meat, Shrimp or Not applicable " required>                                       
                            </div>

                            <div class="form-group">
                            <hr/>
                                <label><b>Ingridient Section &nbsp;</b></label>

                               <label class="radio-inline">
                                  <input type="radio" name="optionsRadioSection"  value="0" checked>Meat
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" name="optionsRadioSection"  value="1">Seafoods
                              </label>    
                               <label class="radio-inline">
                                  <input type="radio" name="optionsRadioSection"  value="2">Vegetables
                              </label>  
                               <label class="radio-inline">
                                  <input type="radio" name="optionsRadioSection" value="3">Fruits
                              </label>  
                               <label class="radio-inline">
                                  <input type="radio" name="optionsRadioSection"  value="4">Spices
                              </label>
                               <label class="radio-inline">
                                  <input type="radio" name="optionsRadioSection"  value="5">Others
                              </label>                                                                
                            </div>    

                            <hr/>
                             <input id="btnAdd" type="submit" name="addToMarket"  class="btn btn-primary mybtn" value="ADD" style="float:right; margin-right: 10px;    padding: 10px 30px;">                                                    
                                                                                                       
                            </div>
                         
                        </form>

                        </div>
                    </div>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Preview List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ING/PROD Name</th>
                                        <th>Brand</th>
                                        <th>Price</th> 
                                        <th>Category</th>                                       
                                        <th>Section</th>                                        
                                        <th>Date Modified</th>                                                                                
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                  $sql = "SELECT * FROM Marketplace WHERE deleted = 0";
                                  $result = mysqli_query($mysqli,$sql);

                                  if (mysqli_num_rows($result) > 0) {                                     

                                      while($row = mysqli_fetch_assoc($result)) {
                                        
                                        $priceNunit = $row['price']. ' / '. $row['in_unit'];

                                          echo '<tr onclick="javascript:showMarketModal(this);">';
                                          echo '<td>'.$row['id'].'</td>';
                                          echo '<td>'.$row['name'].'</td>';
                                          echo '<td>'.$row['ing_brand'].'</td>';
                                          echo '<td> &#x20B1; '.$priceNunit.'</td>';                                          
                                          echo '<td>'.$row['ing_category'].'</td>';
                                          echo '<td>'.$row['ing_section'].'</td>';                                          
                                          echo '<td>'.$row['date_modified'].'</td>';

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

    <div class="modal fade" id="marketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelMarket" aria-hidden="true" >
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelMarket">Market Detail <span id="liquidationDate" style="color:orange;"></span></h4>                                                
                    </div>

                    <form id="myform" action="api-ingridient-marketplace-setup.php" method="post" >
                       
                        <div class="modal-body market-modal-body">

                             
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

  <script language="javascript" type="text/javascript">

        function showMarketModal(row){

            var x=row.cells;
             var id = x[0].innerHTML;
            
            $('.market-modal-body').load('market-modal.php?id=' + id,function(){
                 
                $('#marketModal').modal({show:true}); 
               
            });
                    
        }

          
                       
        </script>

<?php
  include '../template/footer.php';
?>