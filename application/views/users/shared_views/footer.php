  </div>
  <!-- End of Main Content -->
  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Know Your Gene <?php echo date('Y') ?></span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url("Users/logout") ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->

  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

  <!-- Page level custom scripts -->

  <script src="<?php echo base_url('assets/js/datatables.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/datepicker.js') ?>"></script>
   <?php
  //Load Ajax DATA
  if (isset($load_data_ajax)) {
    if (is_array($load_data_ajax)) {
      echo "<script>let JS_ViewData={};";
       echo "$(document).ready(function () {";
      foreach ($load_data_ajax as $data) {
        echo "AjaxPost(new FormData(), `".$data['url']."`, AjaxSuccess, AjaxError,'".$data['var_name']."');";
      }
      echo "function AjaxSuccess(content,varname) {let result = JSON.parse(content);if (result.error) {} else if (result.success) {JS_ViewData[varname] = result.result;}}});</script>";
    }
  }
  ?>
   <?php
  //Load scripts bundle
  if (isset($scripts)) {
    if (is_array($scripts)) {
      foreach ($scripts as $src) {
        echo "<script src='" . base_url($src) . "?d=" . date("Ymdhis") . "'></script>";
      }
    } else {
      echo "<script src='" . base_url($scripts) . "?d=" . date("Ymdhis") . "'></script>";
    }
  }
  ?>
  </body>

  </html>