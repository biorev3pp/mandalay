@extends('layouts.web')
@section('content')
    <div class="wrapper">
      <div class="header sticky-top">
          <div class="header-left">
              <ul class="nav nav-tabs">
                <li class="nav-item hometab">
                  <a class="nav-link active" data-toggle="tab" href="#floorplan">
                      <img src="{{asset('frontend/images/fp-icon.png')}}"/><br>
                      Home</a>
                </li>
                <li class="nav-item floortab">
                  <a class="nav-link" data-toggle="tab" href="#Exteriors">
                      <img src="{{asset('frontend/images/ext-icon.png')}}"/><br>
                      Floor</a>
                </li>
              </ul>
          </div>
          <div class="header-right">
              <div class="logo">
                  <img src="{{asset('frontend/images/logo.png')}}"/>
              </div>
              <div class="plan-name">
                  Residence 1~ Plan 5411: Deseo
              </div>
          </div>
      </div>
      
      <div class="main">
          <div class="left-cont">
              <button class="nav-toggle">Slide button</button>
              <div class="tab-content">
                <div id="floorplan" class="tab-pane active">
                    <div class="gallery">
                        <ul>
                            @php $i=0; @endphp 
                            @forelse($homeList as $home)
                            @php $i++; @endphp
                            <li id="{{$i}}" data-home-id="{{Crypt::encrypt($home->id)}}" class="home_list">
                                <img src="{{asset('images/homes/'.$home->image)}}"/>
                                <h4>{{$home->title}}</h4>
                            </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div id="Exteriors" class="container tab-pane fade">
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
              </div>
          </div>
          <div class="right-cont">
            @php $i=0; @endphp 
            @forelse($homeList as $home)
            @php $i++; @endphp
            <div id="{{$i}}" class="plan-container home_image_full text-center @if($i!=1) d-none @endif">
              <img src="{{asset('images/homes/'.$home->image)}}"/>
            </div>
            @empty
            @endforelse  
            <div class="plan-container floor_image_view text-center d-none">
                <img src=""/>
            </div>
          </div>
      </div>
@endsection
      