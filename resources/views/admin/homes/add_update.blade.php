@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">New <span class="text-success">Home</span>
             </h6><a href="{{url()->previous()}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm pr-2"></i>Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body" id="new_custom_table">
            @if($data)
              {{Form::model($data,array('id'=>'portfolio_form','url'=>url('admin/homes/save')))}}
              {{Form::hidden('record_id',Crypt::encrypt($data->id))}}
              {{Form::hidden('image_update',$data->image,['id'=>'image_update'])}}
            @else
              {{Form::open(array('id'=>'portfolio_form','url'=>url('admin/homes/save')))}}
            @endif
              <div class="form-row">
                <div class="form-row col-md-8">
                  <div class="form-group col-md-6">
                      <label for="inputEmail4">Title</label>
                      {{Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])}}
                  </div>
                  <div class="form-group col-md-6">
                      <label for="inputEmail4">Sub Title</label>
                      {{Form::text('subtitle',null,['class'=>'form-control','id'=>'subtitle','placeholder'=>'Enter Sub Title'])}}
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputEmail4">Area</label>
                      {{Form::text('area',null,['class'=>'form-control','id'=>'area','placeholder'=>'Enter Area'])}}
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputPassword4">Bedrooms</label>
                      {{Form::text('bedrooms',null,['class'=>'form-control','id'=>'bedrooms','placeholder'=>'Enter Bedrooms'])}}
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputAddress">Bathrooms</label>
                      {{Form::text('bathrooms',null,['class'=>'form-control','id'=>'bathrooms','placeholder'=>'Enter Bathrooms'])}}
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputAddress2">Cost</label>
                      {{Form::text('cost',null,['class'=>'form-control','id'=>'cost','placeholder'=>'Enter Cost'])}}
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputAddress2">Garage</label>
                      {{Form::text('garage',null,['class'=>'form-control','id'=>'garage','placeholder'=>'Enter Garage'])}}
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputState">Status</label>
                      {{Form::select('status',$statusArray,null,['class'=>'form-control','id'=>'status'])}}
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary float-left"><i class="fas fa-save fa-sm text-white-50 pr-2"></i>Save</button>
                  </div>
                </div>
                <div class="form-row col-md-4">
                    <div class="form-group">
                        <label for="inputEmail4">Upload Picture</label>
                        <div class="custom-file">
                          {{Form::file('image',['class'=>'custom-file-input image-file','id'=>'portfolioimage'])}}
                          <label class="custom-file-label" for="validatedCustomFile">@if(!isset($data->image)) Choose file @else {{$data->image}} @endif</label>
                        </div>
                        @if(isset($data->image))
                          @if($data->image!='' || $data->image!=null)
                          <div class="col-lg-12 mx-auto p-0 o-hidden">
                            <img src="{{asset('images/homes/'.$data->image)}}" class="img-thumbnail">
                          </div>
                          @endif
                        @endif
                    </div>
                </div>
              </div>                      
            {{Form::close()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection