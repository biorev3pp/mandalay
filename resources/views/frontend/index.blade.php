@extends('layouts.web')
@section('content')
<body id="page-top">
<div id="wrapper">
<ul class="nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
    <ul class="nav nav-tabs d-flex align-items-center justify-content-center">
      <li class="p-2 nav-item hometab">
        <a class="nav-link active" data-toggle="tab" href="#floorplan">
          <img src="{{asset('img/home-icon.png')}}" width="50px">
        </a>
      </li>
      <li class="p-2 nav-item floortab">
        <a class="nav-link" data-toggle="tab" href="#Exteriors">
          <img src="{{asset('img/floor-icon.png')}}" width="50px">
        </a>
      </li>
    </ul>
  </li>
  <div class="tab-content">
    <div id="floorplan" class="tab-pane active">
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Elevation
      </div>
      @php $i=0; @endphp
      @forelse($homeList as $home)
      @php $i++; @endphp
      <li id="{{$i}}" data-home-id="{{Crypt::encrypt($home->id)}}" class="nav-item home_list">
        <a class="nav-link" href="javascript:void(0)">
          <img src="{{asset('images/homes/'.$home->image)}}" class="img-thumbnail"/>
          <span class="d-block text-center">{{$home->title}}</span>
        </a>
      </li>
      @empty
      @endforelse
    </div>

    <div id="Exteriors" class="container tab-pane fade">
        <hr class="sidebar-divider">
        @php $i=0; @endphp
        @forelse($homeList as $home)
        @php $i++; @endphp
        <div id="accordion" class="home_floors @if($i!=1) d-none @endif" data-floor-home-id="{{$i}}">
          @php $j=0; @endphp
          @forelse($home->floors as $floor)
          @php $j++; @endphp
          <div class="card-panel">
            <a class="collapsed card-link floorList" id="{{$floor->id}}" data-toggle="collapse" href="#collapse{{$i}}{{$j}}">
              {{$floor->title}}
            </a>
            <div id="collapse{{$i}}{{$j}}" class="collapse" data-parent="#accordion">
              <ul>
                @forelse($floor->features as $feature)
                  <li>{{$feature->title}}
                      <label class="switch">
                          <input type="checkbox" id="{{$feature->id}}" class="featureBtn">
                          <span class="slider round"></span>
                      </label>
                  </li>
                @empty
                @endforelse
              </ul>
            </div>
          </div>
          @empty
          @endforelse
        </div>
        @empty
        @endforelse
        <div class="floor-plan-btn">
            <button type="button" class="btn btn-finish">Finish & Print</button>
        </div>
    </div>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-1 static-top shadow">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="searchDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                  aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item no-arrow">
          <a class="nav-link" href="javascript:void(0)" id="brandLogo" aria-expanded="false" href="index.html">
            <img src="{{asset('img/logo.png')}}" width="200">
          </a>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item no-arrow d-flex align-items-center justify-content-center">
          @if (Auth::check())
          <a href="{{ url('admin/logout') }}" class="btn btn-success btn-icon-split ">
            <span class="icon text-white-50">
              <i class="fas fa-sign-in-alt"></i>
            </span>
            <span class="text px-4">Logout</span>
          </a>
          @else
          <a href="{{ url('admin/login') }}" class="btn btn-success btn-icon-split ">
            <span class="icon text-white-50">
              <i class="fas fa-sign-out-alt"></i>
            </span>
            <span class="text px-4">Login</span>
          </a>
          @endif
        </li>
      </ul>
    </nav>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="col-xl-10 mx-auto" style="position: relative;overflow: hidden;">
                @php $i=0; @endphp
                @forelse($homeList as $home)
                @php $i++; @endphp
                <div id="{{$i}}" class="plan-container home_image_full text-center @if($i!=1) d-none @endif">
                  <img class="img-fluid rounded mx-auto d-block" id="hubblepic{{$i}}" src="{{asset('images/homes/'.$home->image)}}"/>
                  <input class="m-auto custom-range" type="range" min="1" max="4" value="1" step="0.1" id="zoomer{{$i}}"
                    oninput="deepdive({{$i}})" style="position: absolute; right: 0; width: 90%; top: 0; left: 0;">
                </div>
                @empty
                @endforelse
                <div class="plan-container floor_image_view text-center d-none">
                    <img class="img-fluid rounded mx-auto d-block" id="hubblepic_floor" src=""/>
                    <input class="m-auto custom-range" type="range" min="1" max="4" value="1" step="0.1" id="zoomer_floor"
                     oninput="deepdive('_floor')" style="position: absolute; right: 0; width: 90%; top: 0; left: 0;">
                </div>
              </div>
              <div class="col-xl-1 float-left">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
