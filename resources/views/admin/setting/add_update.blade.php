@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$page_title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">  
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#website-setting" role="tab" aria-controls="custom-content-below-home" aria-selected="false">Website Settings</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Change Password</a>
              </li> -->
            </ul>
            <div class="tab-content" id="website-setting">
              <div class="tab-pane active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                {{Form::model($setting,array('id'=>'setting_form','url'=>url('admin/settings/save')))}}
                <div class="form-group col-md-6">
                  <label for="portfolioimage">Website Logo Image</label>
                  @if(isset($setting))
                  <div class="py-2 image-preview">
                    <img width="130" height="150" src="{{asset('images/'.$setting->logo)}}">
                  </div>
                  @endif
                  <div class="custom-file">
                    {{Form::file('logo',['class'=>'custom-file-input image-file', 'id'=>'logoimage'])}}
                    <label class="custom-file-label" for="logoimage">@if(isset($setting)) {{$setting->logo}} @else Choose file @endif</label>
                  </div>
                </div>
                <div class=" form-group col-md-12">
                  <div><label for="address">Address</label></div>
                  {!! Form::textarea('address', null, ['id' => 'address', 'rows' => 4, 'cols' => 54, 'style'=>'width:100%']) !!}
                </div>
                <div class="form-group col-md-12">
                  <label for="emailaddress">Email Address</label>
                  {{Form::text('email',null,['class'=>'form-control','id'=>'emailaddress','placeholder'=>'Enter Email Address'])}}
                </div>
                <div class="form-group col-md-12">
                  <label for="phonenumbers">Phone Numbers</label>
                  {{Form::text('phone1',null,['class'=>'form-control','id'=>'phonenumbers','placeholder'=>'Enter Phone Number'])}}
                </div>
                <div class="form-group col-md-12">
                  <label for="phonenumbers2">Quick Call Phone Number</label>
                  {{Form::text('phone2',null,['class'=>'form-control','id'=>'phonenumbers2','placeholder'=>'Enter Quick Call Phone Number'])}}
                </div>
                <div class=" form-group col-md-12">
                  <div><label for="googlemap">Google Map</label></div>
                  {!! Form::textarea('map', null, ['id' => 'googlemap', 'rows' => 4, 'cols' => 100, 'style'=>'width:100%']) !!}
                </div>
                <div class="form-group col-md-12">
                  <div class="bg-white">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                {{Form::close()}}
              </div>
              <!-- <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                 Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
              </div> -->
              
            </div>
          </div>
        </div>
        <!-- /.col--> 
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection