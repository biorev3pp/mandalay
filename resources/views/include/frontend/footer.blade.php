<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Your Website 2019</span>
    </div>
  </div>
</footer>
</div>
</div>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
  function deepdive(id) {
    var zoomer = document.getElementById('zoomer'+id);
    var hubblepic = document.getElementById('hubblepic'+id);
    zoomlevel = zoomer.valueAsNumber;
    hubblepic.style.webkitTransform = "scale(" + zoomlevel + ")";
    hubblepic.style.transform = "scale(" + zoomlevel + ")";
  }
  var app_base_url = "{{url('/')}}";
  $(document).click(function (e) {
        $el = $(e.target);
        if ($el.hasClass('toggletag')) {return false;}
        else if ($el.hasClass('nav-toggle')) {
           $("body").toggleClass('close-menu');
        } else {
           $("body").removeClass('close-menu');
        }
    });
</script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
</body>
</html>
