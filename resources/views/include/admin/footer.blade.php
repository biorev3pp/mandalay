<!-- Footer -->
      <footer class="sticky-footer bg-dark shadow text-white">
        <div class="container-fluid my-auto d-flex justify-content-between align-items-center">
          <div class="copyright text-left">
            <span>&copy; 2019 Biorev All Right Reserved.</span>
          </div>
          <div class="copyright text-right">
           <span>Designed &amp; Developed by <em> <a href="http://www.biorev.com/" target="_blank">Biorev LLC</a></em> <!--<a href="javascript:void(0);" class="text-success px-2"> <img src="{{asset('asset/img/biorevRev.png')}}" width="100"></a>--></span>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('asset/vendor/jquery/jquery.min.js')}}"></script>

  <script src="{{asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('asset/js/sb-admin-2.min.js')}}"></script>
  <!-- Page level plugins -->
  <script src="{{asset('asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <!-- Page level custom scripts -->
  <script src="{{asset('asset/js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('js/jquery.toast.js')}}"></script>
  <script src="{{asset('js/custom.js')}}"></script>
  <script src="{{asset('js/form-validate.js')}}"></script>
  <script src="{{asset('js/jquery.validate.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>
  <script type="text/javascript">
  // In your Javascript (external .js resource or <script> tag)
  $(document).ready(function() {
    $(document).find('.js-example-basic-single').select2();
  });
  var app_base_url = "{{url('/')}}";
  </script>
</body>
</html>
