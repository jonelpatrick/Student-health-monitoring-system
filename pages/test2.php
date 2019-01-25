<?php
  include '../template/header.php';
?>


<!-- CSS file -->
<link rel="stylesheet" href="../lib/easycomplete/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="../lib/easycomplete/easy-autocomplete.themes.min.css"> 

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
  .separator{
    margin: 2em 0;
    padding: 2em 0;
    border-top: 1px solid rgba(0,0,0,0.1);
  }
  .toleft{
    float: left;
    width: 200px;
  }
  .toleft.category-area,.btn-left{
    margin-left: 1em;
  }
</style>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <i class="fa fa-shopping-cart"></i> Ingridient Marketplace </h1>
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



        
        <input id="function-data" />
<input id="data-holder" />



          <!-- /.row -->
            <div class="row">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div class="col-lg-12">
                          
                        </div>
                        <hr>

                        <div class="col-lg-8" >
                         

                          <div class="section-area toleft">
                            Filter Section
                            <select id="dd_section" name="dd_section" class="form-control" onchange="showCategory();">
                            <?php 

                              $sql = "SELECT ing_section FROM Marketplace ORDER BY id DESC";
                              $result = mysqli_query($mysqli,$sql);  
                              if (mysqli_num_rows($result) > 0) {                                     

                                while($row = mysqli_fetch_assoc($result)) {

                                  $section = $row['ing_section'];
                                  echo '<option value="'.$section.'">'.$section.'</option>';
                                }
                              }
                              ?>
                            </select>
                          </div>

                          <div class="category-area toleft">                                                  
                              Filter Category
                                <select name="dd_category" class="form-control">
                                <option value="0">Select a section first</option>
                                </select>
                          </div>
                          
                          <div class="toleft btn-left">
                            <button class="btn btn-success" style="padding: 15px 30px;" onclick="showTableFiltered()"> SELECT</button>
                          </div>
                        </div>
                       

                          
                          <div class="table-preview separator col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ING/PROD Name</th>
                                        <th>Brand</th>
                                        <th>Price</th> 
                                        <th>Category</th>                                       
                                        <th>Section</th>     
                                        <?php if( $_SESSION['privilege'] == 'Administrator' ){ ?>                                   
                                        <th>Date Modified</th>
                                        <?php } ?>                                                                                
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
                                          echo '<td>'.$priceNunit.'</td>';                                          
                                          echo '<td>'.$row['ing_category'].'</td>';
                                          echo '<td>'.$row['ing_section'].'</td>';  
                                          if( $_SESSION['privilege'] == 'Administrator' ){                                        
                                            echo '<td>'.$row['date_modified'].'</td>';
                                          }
                                          echo "</tr>";
                                      }
                                  }
                                ?>                                    
                                 
                                </tbody>
                            </table>
                            </div>
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




<?php
  include '../template/footer.php';
?>
<!-- JS file -->
<script src="../lib/easycomplete/jquery.easy-autocomplete.min.js"></script> 

  <script language="javascript" type="text/javascript">
	

		 var options = {
			data: [
				{"character": "Cyclops", "realName": "Scott Summers"},
				{"character": "Professor X", "realName": "Charles Francis Xavier"},
				{"character": "Mystique", "realName": "Raven Darkholme"},
				{"character": "Magneto", "realName": "Max Eisenhardt"}
				],

			getValue: "character",

			list: {

				onSelectItemEvent: function() {
					var value = $("#function-data").getSelectedItemData().realName;

					$("#data-holder").val(value).trigger("change");
				}
			}
		};

		$("#function-data").easyAutocomplete(options);
		                       
            
  </script>