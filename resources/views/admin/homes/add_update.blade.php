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
              <li class="breadcrumb-item active">Homes</li>
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
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="row">
                <div class="col-md-12">
                  <a href="{{url()->previous()}}" class="col-md-1 float-right d-inline btn btn-block btn-primary text-white">Back</a>
                </div>
              </div>
              @if($data)
                {{Form::model($data,array('id'=>'portfolio_form','url'=>url('admin/homes/save')))}}
                {{Form::hidden('record_id',Crypt::encrypt($data->id))}}
              @else
                {{Form::open(array('id'=>'portfolio_form','url'=>url('admin/homes/save')))}}
              @endif

              <div class="row">
                <div class=" form-group col-md-6">
                  <label for="title">Title</label>
                  {{Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])}}
                </div>


                <div class=" form-group col-md-6">
                  <label for="subtitle">Sub Title</label>
                  {{Form::text('subtitle',null,['class'=>'form-control','id'=>'subtitle','placeholder'=>'Enter Sub Title'])}}
                </div>

                <div class=" form-group col-md-6">
                  <label for="area">Area</label>
                  {{Form::text('area',null,['class'=>'form-control','id'=>'area','placeholder'=>'Enter Area'])}}
                </div>

                <div class=" form-group col-md-6">
                  <label for="bedrooms">Bedrooms</label>
                  {{Form::text('bedrooms',null,['class'=>'form-control','id'=>'bedrooms','placeholder'=>'Enter Bedrooms'])}}              
                </div>

                <div class=" form-group col-md-6">
                  <label for="bathrooms">Bathrooms</label>
                  {{Form::text('bathrooms',null,['class'=>'form-control','id'=>'bathrooms','placeholder'=>'Enter Bathrooms'])}} 
                </div>

                <div class=" form-group col-md-6">
                  <label for="cost">Cost</label>
                  {{Form::text('cost',null,['class'=>'form-control','id'=>'cost','placeholder'=>'Enter Cost'])}} 
                </div>

                <div class=" form-group col-md-6">
                  <label for="garage">Garage</label>
                  {{Form::text('garage',null,['class'=>'form-control','id'=>'garage','placeholder'=>'Enter Garage'])}} 
                </div>
  {{-- 
                  <div class="form-group col-md-6">
                    <label for="pageheading">Title</label>
                    {{Form::text('title',null,['class'=>'form-control','id'=>'pageheading','placeholder'=>'Enter Title'])}}
                  </div> --}}

                  <div class="form-group col-md-6">
                    <label for="portfolioimage">Select Image</label>
                    @if(isset($data->image))
                      @if($data->image!='' || $data->image!=null)
                      <div class="py-2 image-preview">
                        <img width="130" height="150" src="{{asset('images/homes/'.$data->image)}}">
                      </div>
                      @endif
                    @endif
                    <div class="custom-file">
                      {{Form::file('image',['class'=>'custom-file-input image-file','id'=>'portfolioimage'])}}
                      <label class="custom-file-label" for="portfolioimage">@if(!isset($data->image)) Choose file @else {{$data->image}} @endif</label>
                    </div>
                  </div>

                  {{-- <div class=" form-group col-md-12">
                    <label for="pagedesc">Page Description</label>
                    {!! Form::textarea('description', null, ['id' => 'pagedesc', 'class'=>'textarea', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
                  </div>
                  <div class="form-group col-md-6">
                    <label for="status">Status</label>
                      {{Form::select('status',$statusArray,null,['class'=>'form-control'])}}
                  </div> --}}
                </div>
                <div class="form-group col-md-12">
                  <div class="bg-white">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              {{Form::close()}}
            </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

@endsection