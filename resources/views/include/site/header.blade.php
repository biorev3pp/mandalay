<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
    <title>{{$page->meta_title}}</title>
    <meta name="description" content="{{$page->meta_description}}">
    <meta name="keywords" content="{{$page->meta_description}}">
    
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('site/css/tablepress.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('site/css/custom.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('site/css/owl.carousel.min.css')}}" type="text/css" media="all">
</head>

<body class="home">

    <header>
        <div id="header">
            <div class="toggle"><a class="toggleMenu" href="#" style="display: none;">Menu</a></div>
            <!-- <div class="top_headbar ">
               <div class="top-bar">
                  <div class="socialbox">
                     <a href="https://www.facebook.com/zcchamirpur"><i class="fa fa-facebook-f"></i></a>
               </div>
               <div class="clearfix"></div>
             </div>
           </div> -->
            <div class="container">
                <div class="col-md-3 col-sm-3 logo_bar">
                    @if(isset($setting->logo))
                    <div class="logo wow bounceInDown">
                        <a href="http://zcchamirpur.com/" class="custom-logo-link" rel="home" itemprop="url"><img width="240" height="120" src="{{asset('images/'.$setting->logo)}}" class="custom-logo" alt="ZCC" itemprop="logo"></a>
                    </div>
                    @endif
                </div>
                <div class="contact">
                    <div class="col-md-9 col-sm-9">
                        <div class="col-md-8 col-sm-8">
                            <div class="col-md-2 col-sm-2">
                                <img src="{{asset('site/images/Location-Icon.png')}}" alt="">
                            </div>
                            <div class="col-md-10 col-sm-10">
                                @if(isset($setting->address)){{$setting->address}}@endif
                            </div>
                        </div>
                        <!--<div class="col-md-4 col-sm-4">
                     </div>-->
                        <div class="col-md-4 col-sm-4">
                            <div class="col-md-4 col-sm-4">
                                <img src="{{asset('site/images/Call-Icon.png')}}" alt="">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <p>@if(isset($setting->phone1)){{$setting->phone1}}@endif</p>
                                <p>@if(isset($setting->phone2)){{$setting->phone2}}@endif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menus">
                <div class="menubox header">
                    <div class="nav">
                        <div class="menu-top-menu-container">
                            <ul class="menu">
                                @forelse ($menus as $menu)
                                    <li><a href="{{$menu->menu_url->page_url}}">{{$menu->menu_title}}</a>
                                        @if($menu->sub_menu)
                                            <ul class="sub-menu">
                                                @foreach($menu->sub_menu as $submenu)
                                                    <li><a href="{{$submenu->menu_url->page_url}}">{{$submenu->menu_title}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>    
                                @empty
                                    
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </header>