
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!--google font-->
      <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,500&display=swap" rel="stylesheet">
      <!--font awesome-->
      <link rel="stylesheet" href="{{asset('frontend/font-aweome/css/all.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
      <title>Mandalay Dashboard</title>
   </head>
   <body>
      <!--header-->
      <div class="h_bg">
         <!--container-->
         <div class="main_con">
            <img src="{{asset('frontend/img/login- logo.png')}}" class="logo" />
            <!--form-->
            <div class="blu_bg">
               <div class="user_ico"> <i class="far fa-user"></i></div>
               <div class="form_data">
                  <form method="POST" class="user" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group bg_whit">
                      <i class="fa fa-user"></i>
                      <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group bg_whit">
                      <i class="fa fa-lock-open"></i>
                      <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <button type="submit">login</button>
                  </form>
                  <!--form-->

                  <!--form-->
                  {{-- <h1><a href="javascript:void(0);">Create Account</a></h1> --}}
               </div>
            </div>
            <!--form-->
         </div>
         <!--container-->
      </div>
      <!--header-->
   </body>
</html>
