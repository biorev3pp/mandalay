<footer>
        <div class="inner">
            <div class="copyright-wrapper">
                <p>Developed By: <a href="https://www.facebook.com/ranjan.kaundal" target="_blank">Ranjan Kaundal</a></p>
            </div>
            <div class="clear"></div>
        </div>
    </footer>
    <script>
        // var site_url = url('/');
    </script>
    <script type="text/javascript" src="{{asset('site/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/tether.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/forms.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function() {
          var owl = $('.owl-carousel');
          owl.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            nav:false,
            dots:false,
          });
        });
        </script>
</body>
</html>