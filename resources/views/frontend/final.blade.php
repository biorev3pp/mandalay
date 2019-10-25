@extends('layouts.web')
@section('content')
  <style>
    .feature-img{
      position: absolute;
      z-index: 111;
      left: 0;
      top: 0;
    }
  </style>
        <!-- Begin Page Content -->
        <div class="container-fluid bg-white pt-4 mb-4">
<div class="sp_marg_">
          <!-- Page Heading -->
          <div class="row">
		  <div id="final_tab_bar">
                      <div class="info-area">
                          <div class="status-box">
                              <ul class="share-options">
                                  <li>
                                      <a href="#"><img src="{{asset('frontend/img/icon-share.png')}}"/></a>
                                  </li>
                                  <li>
                                      <a href="#"><img src="{{asset('frontend/img/icon-download.png')}}"/></a>
                                  </li>
                                  <li>
                                      <a href="#"><img src="{{asset('frontend/img/icon-new.png')}}"/></a>
                                  </li>
                              </ul>
                              <h2>Congratulations!</h2>
                              <p>You've designed your new House</p>
                          </div>
                          <div class="custom-heading">
                              Your Selection
                          </div>
                          <div class="cont-box">
                              <label>Elevation Name:</label> Annefield Farmhouse
                          </div>
                          <div class="custom-heading">
                              Lorem Ipsum
                          </div>
                          <div class="info-table">
                              <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Option</th>
                                    <th>Price</th>
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Door</td>
                                    <td>$16.5</td>
                                    
                                  </tr>
                                  <tr>
                                    <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                     <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                    <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                     <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                     <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                     <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                     <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                     <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                  <tr>
                                    <td>Door</td>
                                    <td>$16.5</td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                          </div>  
                          
                          <div class="custom-heading">
                              Disclaimer
                          </div>
                          <div class="cont-box">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                          </div>
                          
                          <div class="custom-heading">
                              Contact Detail
                          </div>
                          <div class="cont-box">
                              <ul class="contact-info">
                                  <li><img class="float-left" src="{{asset('frontend/img/icon-building.png')}}"><span>Lorem Zirrolli ,Sales Manager<br>Ipsum at North Branch</span></li>
                                  <li><img class="float-left" src="{{asset('frontend/img/icon-phone.png')}}" /> +1234-567-8901</li>
                              </ul>
                          </div>
                          <div class="note-txt">
                              Note: When selecting the upgrade for the siding or accent siding, this upgrade comes as a combo and cannot be upgraded per individual selection.
                          </div>
                      </div>
                  </div>
		  <!--
		  <div id="final_tab_bar">
            <div>
              <h1 class="h3 text-success">Congratulations
                <a href="#" class="btn btn-primary btn-circle btn-sm float-right mx-2">
                  <i class="fas fa-share"></i>
                </a>
                <a href="#" class="btn btn-primary btn-circle btn-sm float-right mx-2">
                    <i class="fas fa-download"></i>
                  </a>
              </h1>

              <hr>
              <div class="d-flex align-items-center justify-content-between">
                <h1 class="h3 text-primary">{{$home->title}}</h1>
                <div class="fp-price ">
                  <span class="pricetag">
                    <small>Starts From</small>
                    {{$home->cost}} </span>
                </div>
              </div>

              You've designed your new House
              <hr>
              <ul class="navbar-nav mr-auto">
                <li class="nav-item text-info text-nowrap my-2">
                  <i class="fas fa-bed pr-2 "></i>{{$home->bedrooms}}
                </li>
                <li class="nav-item text-info text-nowrap my-2">
                  <i class="fas fa-bath pr-2"></i>{{$home->bathrooms}}
                </li>
                <li class="nav-item text-info text-nowrap my-2">
                  <i class="fas fa-car pr-2"></i>{{$home->garage}} Garage
                </li>
                <li class="nav-item text-info text-nowrap my-2">
                  <i class="fas fa-home pr-2"></i>{{$home->area}}
                </li>
                <li class="nav-item text-info text-nowrap my-2">
                  <i class="fas fa-home pr-2"></i>Home Type: <span class="text-success">{{$home->title}}</span> {{$home->subtitle}}
                </li>
              </ul>
              <h1 class="h4 text-white bg-primary p-2 text-center">Floor Plan</h1>
              @php $j=0; @endphp
              @forelse($home->floors as $floor)
              @php $j++; @endphp
              <ul class="navbar-nav mr-auto">
                <li class="nav-link with-arrow text-info text-nowrap hand noSelect" data-toggle="collapse" data-target="#floor{{$j}}" aria-expanded="true" aria-controls="floor{{$j}}">
                  <i class="fas fa-bed pr-2 "></i>{{$floor->title}}
                </li>
              </ul>
              <div class="row mb-2">
                <div class="col-12">
                  <div class="collapse show" id="floor{{$j}}" style="">
                    <div class="card card-body">
                      <div class="sidebar-heading font-weight-bold">Options</div>
                      <ul class="navbar-nav col-12 pl-2">
                        @forelse($floor->features as $feature)
                          @if(in_array($feature->id,$features))
                          <li class="nav-link text-nowrap hand noSelect">
                            {{$feature->title}}
                            
                          </li>
                          @endif
                        @empty
                        @endforelse
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              @endforelse

            </div>
			</div>-->
            <div id="final_tab_bar_r">
              <div class="card o-hidden  mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">
                    <span class="text-success">{{$home->title}} </span>{{$home->subtitle}}
                  </h6>
                </div>
                <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                    <div class="col-lg-9 d-lg-block mx-auto">
                      <img src="{{asset('images/homes/'.$home->image)}}" class="img-fluid">
                    </div>

                  </div>
                </div>
              </div>
              <div class="row mb-5">
                @forelse($home->floors as $floor)
                <div class="card col p-0 mx-2 shadow">
                  <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{$floor->title}}</h6>
                  </div>
                  <div class="card-body">
                    <img src="{{asset('images/floors/'.$floor->image)}}" class="img-fluid">
                    @forelse($floor->features as $feature)
                      @if(in_array($feature->id,$features))
                        <img src="{{asset('images/features/'.$feature->image)}}" class="img-fluid feature-img">
                      @endif
                    @empty
                    @endforelse
                  </div>
                </div>
                @empty
                @endforelse

                <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Floor 1</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Floor 2</a>
                    </li>
                  </ul> -->
                <!-- <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <img src="img/averyMap.png" class="img-fluid">
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <img src="img/averyMap.png" class="img-fluid">
                    </div>
                  </div> -->
              </div>
            </div>
</div>
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
     <!--   <footer class="sticky-footer shadow py-2 bg-dark text-white fixed-bottom">
          <div class="px-3 my-auto d-flex justify-content-between align-items-center">
            <div class="copyright text-left">
              <span>© 2018 Biorev All Right Reserved.</span>
            </div>
            <div class="text-right">
              <span>Designed &amp; Developed by <a href="#" class="text-success px-2"><img src="img/biorevRev.png"
                    width="100"></a></span>
            </div>
          </div>
        </footer>-->
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    
@endsection