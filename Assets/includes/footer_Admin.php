<script>
     const base_url = "<?= base_url(); ?>";
</script>

<!-- Essential javascripts for application to work-->
<script type="text/javascript" src="<?php echo media(); ?>js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/main.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/fontawesome.js"></script>

<!-- The javascript plugin to display page loading on top-->
<script type="text/javascript" src="<?php echo media(); ?>js/plugins/pace.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/plugins/sweetalert.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo media(); ?>js/plugins/jquery.dataTables.min.js"></script> -->
<!-- <script type=" text/javascript" src="<?php echo media(); ?>js/plugins/dataTables.bootstrap.min.js"></script> -->

<!-- JS DataTable -->
<script type="text/javascript" src="<?php echo media(); ?>DataTables/datatables.min.js"></script>

<!-- JS Para usar botones en datatables -->
<script type="text/javascript" src="<?php echo media(); ?>DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>


<!-- JS Propios -->
<?php

switch ($data['page_name']) {
     case 'Productos':
          echo $data['page_name'];
          echo '<script type="text/javascript" src="<?php echo media(); ?>js/function_Products.js"></script>';
          echo "hl";
          break;
}

?>
<!-- 
if($data['page_name'] == 'Productos'){
<script type="text/javascript" src="<?php echo media(); ?>js/function_Products.js"></script>
}elseif(){

} -->
<!-- <script type="text/javascript" src="<?php echo media(); ?>js/function_Admin.js"></script> -->


</body>

</html>