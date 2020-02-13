@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">New <span class="text-success">Community</span>
             </h6><a href="{{url()->previous()}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm pr-2"></i>Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body" id="new_custom_table">
            @if($data)
              {{Form::model($data,array('id'=>'portfolio_form','url'=>url('admin/communities/save')))}}
              {{Form::hidden('record_id',Crypt::encrypt($data->id))}}
            @else
              {{Form::open(array('id'=>'portfolio_form','url'=>url('admin/communities/save')))}}
            @endif
              <div class="form-row">
                <div class="col-md-6 col-xs-12 col-sm-8">
                    <div class="form-group">
                        <label for="name">Community name</label>
                        {{Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Enter Community Name'])}}
                    </div>
                    <div class="form-group">
                        <label for="url">Community URL</label>
                        {{Form::text('url',null,['class'=>'form-control','id'=>'url','placeholder'=>'Enter Community URL'])}}
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        {{Form::text('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Enter Community Lead Email'])}}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-left"><i class="fas fa-save fa-sm text-white-50 pr-2"></i>Save</button>
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