<footer class="fixed-bottom">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-6 text-md-left text-center">
                      &copy; 2018 Biorev All Right Reserved.
                  </div>
                  <div class="col-md-6 text-md-right text-center">
                      Designed &#38; Developed by <a target="_blank" href="http://biorev.com">Biorev LLC</a>
                  </div>
              </div>
          </div>
      </footer>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      
      <script>
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
  </body>
</html>