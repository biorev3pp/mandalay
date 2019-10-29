@extends('layouts.web')
@section('content')
  <style>
    .disp_none{
      display: none !important;
    }
    .text-info-white{
      color: #ffffff;
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
    #image-graggble {
      cursor: all-scroll;
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
		  <!-- <button class="nav-toggle">Slide button</button>-->
            <div class="c_D_bar">
              <ul
                class="nav bg-primary d-flex d-block align-items-center justify-content-center" id="padd">
                <li class="col-6 text-center hand customNav active tabDiv" id="home">
                  <img src="{{asset('frontend/img/ext-icon.png')}}">

                  <!--<h5>Plan</h5>-->
                </li>
                <li class="col-6 text-center hand customNav tabDiv" id="floor">
                  <img src="{{asset('frontend/img/fp-icon.png')}}" width="30">

                 <!-- <h5>Floor</h5>-->
                </li>
              </ul>
			  <div class="accord">
              <div class="custom-scroll col-12 tabDivSection" id="home">
			  <h6>Elevation</h6>
                <ul class="navbar-nav" id="div_pos">

                  @php $i=0; @endphp
                  @forelse($homeList as $home)
                  @php $i++; @endphp
                  <li id="{{$i}}" data-home-id="{{Crypt::encrypt($home->id)}}" class="nav-item home_list">
                    <a class="nav-link" href="javascript:void(0)">
                      <img src="{{asset('images/homes/'.$home->image)}}" alt="{{$home->title}}" class="img-thumbnail">
                      <h4>{{$home->title}}</h4>
                    </a>
                  </li>
                  <!--<hr class="my-1 bg-gradient-success">-->
                  @empty
                  @endforelse
                </ul>
              </div>

              <div class="custom-scroll tabDivSection disp_none" id="floor">
			  <p class="f_de">Floor</p>
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
						            <!--<p class="f_de">FlexDesign</p>-->
                          <!--<div class="sidebar-heading font-weight-bold">Options</div>-->
                          <ul class="navbar-nav col-12 " id="left_togg">
                            @forelse($floor->features as $feature)
                            <li class="nav-link  hand noSelect_{{$feature->id}}">
                             <span> {{$feature->title}} </span>
                              <label

                                data-conflicts="{{$feature->features_acl->conflicts}}"
                                data-dependency="{{$feature->features_acl->dependency}}"
                                data-togetherness="{{$feature->features_acl->togetherness}}"
                                data-self="{{$feature->id}}"

                                class="ui-switch ui-switch-success ui-switch-sm mb-0 float-right
                                <?php if (($feature->features_acl->count())) {?> manageToggle <?php }?>">
                                <input data-check-floor-id="{{$floor->id}}" type="checkbox" class="featureBtn conflicts_{{$feature->id}} dependency_{{$feature->id}} self_{{$feature->id}} togetherness_{{$feature->id}}" id="{{$feature->id}}"><i></i>
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
                <button type="button" class="btn btn-finish finishBtn">Finish &amp; Print</button>
                {{Form::open(array('url'=>url('home-final'),'id'=>'finishPage_form'))}}
                {{Form::hidden('home_id',$defaultHome->id)}}
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
				  <div class="top_spa position-relative" style="min-height: 700px; position: relative;">
                  <div class="row">
                    @php $i=0; @endphp
                    @forelse($homeList as $home)
                    @php $i++; @endphp
                    <div id="{{$i}}" class="col-lg-9 d-lg-block mx-auto position-relative home_image_full @if($i!=1) disp_none @endif">
                      <div class="position-relative">
                        <img src="{{asset('images/homes/'.$home->image)}}" class="img-fluid" id="v_h">
                      </div>
                    </div>
                    @empty
                    @endforelse
                    <div class="col-lg-9 d-lg-block mx-auto floor_image_view disp_none position-absolute" id="image-graggble" >
                      <div class="position-relative">
                        <img src="" class="img-fluid position-absolute">
                      </div>
                    </div>
					<!-- zoom area-->

					<!--zoom area-->
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
			 <div class="home_column_">
              <img src="{{asset('frontend/img/h_ico.png')}}">
			  <div class="div_co">
             <p>{{$home->title}} {{$home->subtitle}}</p></div>
            </div>
           <div class="data_val">
            <ul>
			<li>
              <img src="{{asset('frontend/img/ico1.png')}}">
              <span>{{$home->area}}</span>
           </li>
		   <li>

              <img src="{{asset('frontend/img/ico2.png')}}" >
              <span>{{$home->bedrooms}}</span>
            </li>
			<li>

              <img src="{{asset('frontend/img/ico3.png')}}" >
              <span>{{$home->bathrooms}}</span>
           <li>

              <img src="{{asset('frontend/img/ico4.png')}}" >
              <span>{{$home->garage}}</span>
            </li>
			</ul>
			</div>
            <div class="two_button_sp">

                <span class="p_tag">
				 <small>Starts From</small>
				{{$home->cost}}
                 
                  </span>


            <button type="button" class="btn_mortgage" data-toggle="modal" data-target="#mortageModal">
              Mortgage
            </button>
			</div>
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
        <div class="row">
          <div class="col-md-6 mc_field">
              <div class="calculator"></div>
              {{-- <div class="form-group">
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
              --}}
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="zoomer_section">
  <div class="z_bar">
    <div class="r_fresh float-left"> <img src="{{asset('frontend/img/rotat.png')}}"></div>
    <div class="float-left">
      <input type="range" min="0" max="5" value="0" id="zoom_input"  class="slider">
    </div>
  </div>
</div>

@endsection
