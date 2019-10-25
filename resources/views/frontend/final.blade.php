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
		    <div class="col-lg-4">
          <div class="info-area">
            <div class="status-box">
              <ul class="share-options">
                  <li>
                      <a href="#"><img src="{{asset('asset/img/icon-share.png')}}"/></a>
                  </li>
                  <li>
                      <a href="#"><img src="{{asset('asset/img/icon-download.png')}}"/></a>
                  </li>
                  <li>
                      <a href="#"><img src="{{asset('asset/img/icon-new.png')}}"/></a>
                  </li>
              </ul>
              <h2>Congratulations!</h2>
              <p>You've designed your new House</p>
            </div>
            <div class="custom-heading">
                Your Selection
            </div>
            <div class="cont-box">
              <label>Elevation Name:</label> {{$home->title}}
            </div>
            @php $j=0; @endphp
            @forelse($home->floors as $floor)
            @php $j++; @endphp
              <div class="custom-heading">
                {{$floor->title}}
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
                      @forelse($floor->features as $feature)
                        @if(in_array($feature->id,$features))
                        <tr>
                          <td>{{$feature->title}}</td>
                          <td>{{$feature->price}}</td>
                        </tr>
                        @endif
                      @empty
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            @empty
            @endforelse  
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
                  <li><img class="float-left" src="{{asset('asset/img/icon-building.png')}}"><span>Lorem Zirrolli ,Sales Manager<br>Ipsum at North Branch</span></li>
                  <li><img class="float-left" src="{{asset('asset/img/icon-phone.png')}}" /> +1234-567-8901</li>
              </ul>
            </div>
            <div class="note-txt">
                Note: When selecting the upgrade for the siding or accent siding, this upgrade comes as a combo and cannot be upgraded per individual selection.
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card o-hidden  mb-4">
            <div class="top_spa">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-11 d-lg-block mx-auto">
                  <img src="{{asset('images/homes/'.$home->image)}}" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-5">
            @forelse($home->floors as $floor)
            <div class="card col p-0 mx-2">
              <div class="custom-heading_1">
               {{$floor->title}}
              </div>
              <div class="card-body position-relative">
		            <div class="img_s position-relative">
                  <img src="{{asset('images/floors/'.$floor->image)}}" class="img-fluid position-absolute">
				        </div>
                @forelse($floor->features as $feature)
                  @if(in_array($feature->id,$features))
                    <div class="img_s" style="position: relative;">
                      <img style="position: absolute;" src="{{asset('images/features/'.$feature->image)}}" class="img-fluid">
                    </div>
                  @endif
                @empty
                @endforelse
              </div>
            </div>
            @empty
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

    
@endsection