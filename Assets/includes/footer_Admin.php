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

<!-- JS propios -->
<?php
switch ($data['page_name']) {
     case 'Dashboard':
          echo '<script type="text/javascript" src="' . base . media . $data['page_functions'] . '"></script>';
          break;
     case 'Clientes':
          echo '<script type="text/javascript" src="' . base . media . $data['page_functions'] . '"></script>';
          break;
     case 'Productos':
          echo '<script type="text/javascript" src="' . base . media . $data['page_functions'] . '"></script>';
          break;
     case 'Facturas':
          echo '<script type="text/javascript" src="' . base . media . $data['page_functions'] . '"></script>';
          break;
     case 'Usuarios':
          echo '<script type="text/javascript" src="' . base . media . $data['page_functions'] . '"></script>';
          break;
     case 'Roles':
          echo '<script type="text/javascript" src="' . base . media . $data['page_functions'] . '"></script>';
          break;
     default:
          # code...
          break;
}

?>

</body>

</html>