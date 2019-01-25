 <?php
 require '../connection/dbconnect.php';
 include 'session.php';

 $section = $_GET['section'];
 $category = $_GET['category'];

 ?>
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
     if($category == 'All'){
     	$sql = "SELECT * FROM Marketplace WHERE deleted = 0 AND ing_section = '$section' ORDER BY name ASC";	
     }else{
     	$sql = "SELECT * FROM Marketplace WHERE deleted = 0 AND ing_section = '$section' AND ing_category = '$category' ORDER BY name ASC";	
     }
      
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


    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
        
          // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    
    });
 
</script>