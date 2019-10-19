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
              <li class="breadcrumb-item active">Floors</li>
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
                <div class="col-md-6">
                  Home: <b>{{$floor->home->title}}</b> Floor: <b>{{$floor->title}}</b>
                </div>
                <div class="col-md-6">
                  <a href="{{url()->previous()}}" class="col-md-2 float-right d-inline btn btn-block btn-primary text-white">Back</a>
                </div>
              </div>
              @if($data)
                {{Form::model($data,array('id'=>'floors_form','url'=>url('admin/features/save')))}}
                {{Form::hidden('record_id',Crypt::encrypt($data->id))}}
                {{Form::hidden('floor_id',$data->floor->id)}}
              @else
                {{Form::open(array('id'=>'floors_form','url'=>url('admin/features/save')))}}
                {{Form::hidden('floor_id',$floor->id)}}
              @endif
              <div class="row">
                <div class=" form-group col-md-3">
                  <label for="title">Main Option</label>
                  {{Form::select('main_option',$features,null,['class'=>'form-control'])}}
                </div>
                <div class="form-group col-md-3">
                  <label>Conflict</label>
                  <div class="select2-purple">
                    {{Form::select('conflict',$features,null,['class'=>'select2','multiple'=>'multiple','data-placeholder'=>'Select option','style'=>'width:100%'])}}
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label>Togetherness</label>
                  <div class="select2-purple">
                    {{Form::select('togetherness',$features,null,['class'=>'select2','multiple'=>'multiple','data-placeholder'=>'Select option','style'=>'width:100%'])}}
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label>Dependency</label>
                  <div class="select2-purple">
                    {{Form::select('dependency',$features,null,['class'=>'select2','multiple'=>'multiple','data-placeholder'=>'Select option','style'=>'width:100%'])}}
                  </div>
                </div>
              </div>
              <div class="row">
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
@endsection