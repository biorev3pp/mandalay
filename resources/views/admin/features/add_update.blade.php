@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12">
         <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <h6 class="m-0 font-weight-bold text-primary">@if($data) Update @else Add New @endif <span class="text-success">Feature</span>
               </h6>
               <a href="{{url()->previous()}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50 pr-2"></i>Back</a>
            </div>
            <!-- Card Body -->
            <div class="card-body" id="new_custom_table">
              @if($data)
                {{Form::model($data,array('id'=>'floors_form','url'=>url('admin/features/save')))}}
                {{Form::hidden('record_id',Crypt::encrypt($data->id))}}
                {{Form::hidden('floor_id',$data->floor->id)}}
                {{Form::hidden('image_update',$data->image,['id'=>'image_update'])}}
              @else
                {{Form::open(array('id'=>'floors_form','url'=>url('admin/features/save')))}}
                {{Form::hidden('floor_id',$floor->id)}}
              @endif 
                  <div class="form-row">
                     <div class="form-row col-md-8">
                        <div class="form-group col-md-9">
                           <label for="inputEmail4">Title</label>
                           {{Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])}}
                        </div>
                        <div class="form-group col-md-9">
                           <div class="form-row">
                              <div class="form-group">
                                 <label for="inputEmail4">Upload Picture</label>
                                 <div class="custom-file">
                                  {{Form::file('image',['class'=>'custom-file-input image-file', 'id'=>'portfolioimage'])}}
                                    <label class="custom-file-label" for="validatedCustomFile">@if(!isset($data->image)) Choose file @else {{$data->image}} @endif</label>
                                 </div>
                                 @if(isset($data->image))
                                  @if($data->image!='' || $data->image!=null)
                                  <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img src="{{asset('images/features/'.$data->image)}}" class="img-thumbnail">
                                  </div>
                                  @endif
                                @endif
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12">
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