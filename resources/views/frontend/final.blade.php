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
                      <a href="#"><img src="{{asset('asset/img/icon-share.png')}}" title="Share"/></a>
                  </li>
                  <li>
                      {{Form::open(array('url'=>url('download-pdf'),'id'=>'pdf_form'))}}
                      {{Form::hidden('home_id',$home->id)}}
                      @forelse($features as $feature)
                      {{Form::hidden('feature_id[]',$feature)}}
                      @php $i = 1; @endphp
                      @empty
                      @php $i = 0; @endphp
                      @endforelse
                        <a href="#"  class="@if($i==1) downloadPDFBtn @endif"><img src="{{asset('asset/img/icon-download.png')}}" title="Download PDF"/></a>
                      {{Form::close()}}
                  </li>
                  <li>
                    {{Form::open(array('url'=>url('save-floorplan'),'id'=>'pdf_form'))}}
                    {{Form::hidden('home_id',$home->id)}}
                    @forelse($features as $feature)
                    {{Form::hidden('feature_id[]',$feature)}}
                    @php $i = 1; @endphp
                    @empty
                    @php $i = 0; @endphp
                    @endforelse
                      <a href="#" style="font-size: 20px; position: relative; top: 3px;" class="@if($i==1) favFloorBtn @endif"><i class="fa fa-heart"></i></a>
                    {{Form::close()}}
                  </li>
                  <li>
                      <a href="{{url('/')}}"><img src="{{asset('asset/img/icon-new.png')}}" title="New Home"/></a>
                  </li>
              </ul>
              <h2>Congratulations!</h2>
              <p>You've designed your new Home</p>
            </div>
            <div class="custom-heading">
                Your Home
            </div>
            <div class="cont-box">
              <!-- <label>Elevation Name:</label> --> {{$home->title}}
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
            <div class="cont-box text-justify">
                <p>Available home plans, pricing, features, and community information is subject to change at any time prior to sale without notice or obligation. In the continuing effort to improve our homes, builder reserves the right to modify the interior and exterior design, specifications, locations, sizes, design features and prices of the homes. Modifications may vary by home and are subject to change without notice. All dimensions and square footages are approximate and can vary in production. No representations of any type are made by this floor plan. Colors shown are approximate representations of actual materials and are not intended to be an exact color match. Please consult our sales representative for details. We at Mandalay Homes want to be of further assistance to you, if you have questions please feel free to contact the Sales Department at 855-955-6466 ext. 1 �2020 Mandalay Homes
</p>
            </div>
            <div class="custom-heading">
                Contact Mandalay Homes
            </div>
            <div class="cont-box">
              <ul class="contact-info">
                  <li><img class="float-left" src="{{asset('asset/img/icon-building.png')}}"><span>{{ $settings->email }}</span></li>
                  <li><img class="float-left" src="{{asset('asset/img/icon-phone.png')}}" />{{ $settings->phone }}</li>
              </ul>
            </div>
            {{-- <div class="note-txt">
                Note: When selecting the upgrade for the siding or accent siding, this upgrade comes as a combo and cannot be upgraded per individual selection.
            </div> --}}
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