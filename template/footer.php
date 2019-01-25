 </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

      <!--date time picker -->
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
    <!-- Date time picker -->

     <!-- auto complete form -->
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
     
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
         $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
        });
         $('#datetimepicker1').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
        });
          $('#datetimepicker2').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
        });
            $('#datetimepicker3').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
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
             
</body>

</html>
