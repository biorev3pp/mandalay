@extends('layouts.web')
@section('content')
    <div class="wrapper">
      <div class="header sticky-top">
          <div class="header-left">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#floorplan">
                      <img src="{{asset('frontend/images/fp-icon.png')}}"/><br>
                      Home</a>
                </li>
                <li class="nav-item">
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
                            @forelse($homeList as $home)
                            <li>
                                <img src="{{asset('images/homes/'.$home->image)}}"/>
                                <h4>{{$home->title}}</h4>
                            </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div id="Exteriors" class="container tab-pane fade">
                    <div id="accordion">
                        @php $i=0; @endphp 
                        @forelse($defaultHome->floors as $floor)
                          @php $i++; @endphp
                          <div class="card-panel">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapse{{$i}}">
                              {{$floor->title}}
                            </a>
                            <!-- <div id="collapse{{$i}}" class="collapse show" data-parent="#accordion">
                              <h2>FlexDesign</h2>
                                <ul>
                                  <li>Den Office
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Door
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Fire place
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Gas
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Great room
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Kitchen
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Shower
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Sliding door
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Toilet
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Lorem
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                                  <li>Lorem Ipsum
                                      <label class="switch">
                                          <input type="checkbox">
                                          <span class="slider round"></span>
                                      </label>
                                  </li>
                              </ul>
                            </div> -->
                          </div>
                        @empty
                        @endforelse
                      </div>
                    
                    <div class="floor-plan-btn">
                        <button type="button" class="btn btn-finish">Finish & Print</button>
                    </div>                    
                </div>
              </div>
          </div>
          <div class="right-cont">
              <div class="plan-container text-center">
                  <img src="{{asset('images/homes/'.$defaultHome->image)}}"/>
              </div>
          </div>
      </div>
@endsection
      