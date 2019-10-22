<footer class="sticky-footer shadow py-2 bg-dark text-white fixed-bottom">
          <div class="px-3 my-auto d-flex justify-content-between align-items-center">
            <div class="copyright text-left">
              <span>© 2018 Biorev All Right Reserved.</span>
            </div>
            <div class="text-right">
              <span>Designed &amp; Developed by Biorev<!--<a href="#" class="text-success px-2"><img src="{{asset('frontend/img/biorevRev.png')}}"
                    width="100"></a>--></span>
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
    <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('frontend/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('frontend/js/custom.js')}}"></script>

    <script src="{{asset('frontend/js/jquery.loan-calculator.js')}}"></script>
    
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
      var app_base_url = "{{url('/')}}";

      $("#adv_calc").click(function(){
        if($(".advance_calc").hasClass('hide')){
          $(".advance_calc").removeClass('hide');
          $(".advance_calc").addClass('show');
        }
        else{
          $(".advance_calc").removeClass('show');
          $(".advance_calc").addClass('hide');
        }
      });
      $(function() {
        $('#toggle-event').change(function() {
          $('#console-event').html('Toggle: ' + $(this).prop('checked'))
        })
      });
    </script>
</body>

</html>