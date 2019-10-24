  @extends('layouts.web')
@section('content')
  <style>
    .disp_none{
      display: none !important;
    }
    .text-info-white{
      color: #ffffff;
    }
    <!--.with-arrow::after{
      color: #ffffff;
    }-->
    .floor_image_view{
      position: relative;
    }
    .feature-img{
      position: absolute;
      z-index: 111;
      left: 0;
      top: 0;
    }
    i.disabled{
      cursor: not-allowed !important;
    }
  </style>
        <!-- Begin Page Co    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">    
ntent -->
        <div class="container-fluid bg-white">
<div class="spacer_margin">
          <!-- Page Heading -->
          <div class="row">
		  <!-- left bar start-->
		  <div id="top_tab">
            <div class="c_D_bar">
              <ul
                class="nav bg-primary d-flex d-block align-items-center justify-content-center" id="padd">
                <li class="col-6 text-center hand customNav active tabDiv" id="home">
                  <img src="{{asset('frontend/img/ext-icon.png')}}">
				  
                  <h5>Home</h5>
                </li>
                <li class="col-6 text-center hand customNav tabDiv" id="floor">
                  <img src="{{asset('frontend/img/fp-icon.png')}}" width="30">
				  
                  <h5>Floor</h5>
                </li>
              </ul>
			  <div class="accord">
              <div class="custom-scroll bg-primary col-12 tabDivSection" id="home">
                <ul class="navbar-nav">
                  @php $i=0; @endphp 
                  @forelse($homeList as $home)
                  @php $i++; @endphp
                  <li id="{{$i}}" data-home-id="{{Crypt::encrypt($home->id)}}" class="nav-item home_list">
                    <a class="nav-link" href="javascript:void(0)">
                      <img src="{{asset('images/homes/'.$home->image)}}" alt="{{$home->title}}" class="img-thumbnail">
                      <h4 class="h4 m-0 mt-2 text-center text-white">{{$home->title}}</h4>
                    </a>
                  </li>
                  <hr class="my-1 bg-gradient-success">
                  @empty
                  @endforelse
                </ul>
              </div>

              <div class="custom-scroll tabDivSection disp_none" id="floor">
                @php $i=0; @endphp 
                @forelse($homeList as $home)
                @php $i++; @endphp
                  @php $j=0; @endphp 
                  @forelse($home->floors as $floor)
                  @php $j++; @endphp
                  <ul class="home_floors @if($i!=1) disp_none @endif" data-floor-home-id="{{$i}}" id="grey_">
                    <li class="nav-link with-arrow text-info-white text-nowrap hand noSelect floorList" id="{{$floor->id}}" data-toggle="collapse" data-target="#floor{{$i}}{{$j}}" aria-expanded="true" aria-controls="floor{{$i}}{{$j}}">
                      <!--<i class="fas fa-bed pr-2 "></i>-->{{$floor->title}}
                    </li>
                  </ul>
                  <div class="row home_floors @if($i!=1) disp_none @endif" data-floor-home-id="{{$i}}">
                    <div class="col-12">
                      <div class="collapse" id="floor{{$i}}{{$j}}" style="">
                        <div class="card">
						<p class="f_de">FlexDesign</p>
                          <!--<div class="sidebar-heading font-weight-bold">Options</div>-->
                          <ul class="navbar-nav col-12 " id="left_togg">
                            @forelse($floor->features as $feature)
                            <li class="nav-link text-nowrap hand noSelect_{{$feature->id}}">
                             <span> {{$feature->title}} </span>
                              <label 
                               
                                data-conflicts="{{$feature->features_acl->conflicts}}"  
                                data-dependency="{{$feature->features_acl->dependency}}"  
                                data-togetherness="{{$feature->features_acl->togetherness}}" 
                                data-self="{{$feature->id}}" 
                              
                                class="ui-switch ui-switch-success ui-switch-sm mb-0 float-right 
                                <?php if(($feature->features_acl->count())) {?> manageToggle <?php } ?>">
                                <input type="checkbox" class="featureBtn conflicts_{{$feature->id}} dependency_{{$feature->id}} self_{{$feature->id}} togetherness_{{$feature->id}}" id="{{$feature->id}}"><i></i>
                              </label>
                            </li>
                            @empty
                            @endforelse
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  @endforelse
                @empty
                @endforelse
              </div>
              </div><!--div scroller-->
              <div class="floor-plan-btn">
                {{Form::open(array('url'=>url('home-final')))}}  
                {{Form::hidden('home_id',$defaultHome->id)}}
                <button type="submit" class="btn btn-finish">Finish &amp; Print</button>
                {{Form::close()}}
              </div>
            </div>
			</div>
			<!--left bar close-->
			
			
            <div class="right_panel_d">
              <div class="card">
               <!--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  @php $i=0; @endphp 
                  @forelse($homeList as $home)
                  @php $i++; @endphp
                  <h6 id="{{$i}}" class="m-0 font-weight-bold text-primary home_image_title @if($i!=1) disp_none @endif">
                    <span class="text-success">{{$home->title}} </span>{{$home->subtitle}}
                  </h6>
                  @empty
                  @endforelse
                </div>-->
                <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                    @php $i=0; @endphp 
                    @forelse($homeList as $home)
                    @php $i++; @endphp
                    <div id="{{$i}}" class="col-lg-9 d-lg-block mx-auto home_image_full @if($i!=1) disp_none @endif">
                      <img src="{{asset('images/homes/'.$home->image)}}" class="img-fluid">
                    </div>
                    @empty
                    @endforelse 
                    <div class="col-lg-9 d-lg-block mx-auto floor_image_view disp_none">
                      <img src="" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
			   <!-- Footer -->
        <footer class="sticky-footer" id="spacer_">
		<div class="all_cen">
          @php $i=0; @endphp 
          @forelse($homeList as $home)
          @php $i++; @endphp
          <div id="{{$i}}" class="px-3 my-auto d-flex align-items-center home_image_footer @if($i!=1) disp_none @endif">
           <!-- <div class="col-3">
              <img src="{{asset('frontend/img/footerHome.png')}}" width="100" class="f_left">
			  <h5 class="text-primary">{{$home->title}} {{$home->subtitle}}</h5>
            </div>-->
			 <span class="text-center mx-3">
              <img src="{{asset('frontend/img/hom.png')}}" width="40">
             <span class="d-block text-black-50">{{$home->title}} {{$home->subtitle}}</span>
            </span>
           
            <span class="text-center mx-3">
              <img src="{{asset('frontend/img/squar-feet-icon.png')}}" width="40">
              <span class="d-block text-black-50">{{$home->area}}</span>
            </span>
            <span class="text-center mx-3">
              <img src="{{asset('frontend/img/bedroom-icon2.png')}}" width="40">
              <span class="d-block text-black-50">{{$home->bedrooms}}</span>
            </span>
            <span class="text-center mx-3">
              <img src="{{asset('frontend/img/bedroom-icon.png')}}" width="40">
              <span class="d-block text-black-50">{{$home->bathrooms}}</span>
            </span>
            <span class="text-center mx-3 ">
              <img src="{{asset('frontend/img/car-icon.png')}}" width="40">
              <span class="d-block text-black-50">{{$home->garage}}</span>
            </span>
            <div class="ml-3 pl-5 border-primary">
              <div class="fp-price">
                <span class="pricetag">
                  <small>Starts From</small>
                  {{$home->cost}}</span>
              </div>
            </div>
            <button type="button" class="btn btn-success btn-icon-split btn-lg mr-auto ml-3" data-toggle="modal" data-target="#mortageModal">
              <span class="icon text-white-50">
                <i class="fas fa-car-alt"></i>
              </span>
              <span class="text">Mortrage </span> 
            </button>
          </div>
          @empty
          @endforelse
        </footer>
	</div>
            </div>

          </div>
		  </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

       
        <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="mortageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-white" style="background:#2a2c30;">
        <h5 class="modal-title">Mortgage Calculator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mortagC">
        <div class="calculator"></div>
        <div class="row">
          <div class="col-md-6 mc_field">
              <div class="form-group">
                <label for="">Home price</label>
                <input type="text" class="form-control home_price" value="300000" readonly placeholder="3000000">
              </div>
              <div class="form-group">
                <label class="d-block">Down payment</label>
                <div class="row" style="padding:0 0.8em;">
                  <input type="text" class="form-control col-sm-9 downpay_amt">
                  <input type="text" value="" class="form-control col-sm-3 downpay_rate">
                </div>
                <div class="overlay-text">%</div>
              </div>
              <div class="form-group">
                <label for="">Loan program</label>
                <select class="form-control duration">
                    <option value="30" selected="selected">30 - Year Fixed</option>
                    <option value="15">15 - Year Fixed</option>
                    <option value="5">5/1 ARM</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Interest rate <a href="Javascript:void(0)" id="adv_calc" class=" text-success">Advanced</a></label>
                <input type="text" class="form-control intrst">
                <div class="overlay-text">%</div>
              </div>
             
              <div class="advance_calc hide">
                  <div class="form-group">
                      <label class="ui-switch ui-switch-success ui-switch-sm mb-0">
                        <input type="checkbox" id="1" class="featureBtn"><i></i>
                        Include PMI <span class="fa fa-question-circle"></span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="ui-switch ui-switch-success ui-switch-sm mb-0">
                        <input type="checkbox" id="1" class="featureBtn"><i></i>
                        Include taxes/insurance
                      </label>
                    </div>
                <div class="form-group">
                  <label for="">Property tax <i class="fa fa-question-circle"></i></label>
                  <div class="row" style="padding:0 0.8em;">
                    <input type="text" class="form-control col-sm-10 property_tx">
                    <div class="ot_prt1">/year</div>
                    <input type="text"  class="form-control col-sm-2 property_tx_rate">
                  </div>
                  <div class="overlay-text">%</div>
                </div>
                <div class="form-group">
                  <label for="">Home insurance <i class="fa fa-question-circle"></i></label>
                  <input type="text" class="form-control home_insurance">
                  <div class="overlay-text">/Year</div>
                </div>
                <div class="form-group">
                  <label for="">HOA dues <i class="fa fa-question-circle"></i></label>
                  <input type="text" class="form-control _hoa">
                  <div class="overlay-text">/Month</div>
                </div>
              </div>
          </div>
          <div class="col-md-6 mortage-details">
              <div class="circle-div"><div class="circle"><span class="estimate">$ 1,280</span></div></div>
              <div class="mortage-result">
                <div class="price-header">TOTAL PRICE OF HOME</div>
                <div class="price-text-big">$ 300000</div>
                <div class="price-text">Base Price<span class='price_bp'>$ 300000</span></div>
                {{-- <div class="price-text">Designs Selected  <span class='price_ds'>$ 1,519</span></div> --}}
                <div class="price-header">MONTHLY ESTIMATED PAYMENT</div>
                <div class="price-text-big" id="installment"></div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
        