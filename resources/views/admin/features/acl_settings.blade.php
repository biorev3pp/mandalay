@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12">
         <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <h6 class="m-0 font-weight-bold text-primary">ACL <span class="text-success">Settings</span>
               </h6>
               <a href="{{url()->previous()}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50 pr-2"></i>Back</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                @if(isset($acl_settings))
                  {{Form::model($acl_settings,array('url'=>url('admin/features/save-acl'), 'id'=>'acl_setting_form'))}}
                @else
                  {{Form::open(array('url'=>url('admin/features/save-acl'), 'id'=>'acl_setting_form'))}}
                @endif  
                  {{Form::hidden('floorid',$floor->id)}}  
                <table class="table table-bordered aclTable" width="100%" cellspacing="0">
                   <thead>
                      <tr class="bg-dark text-white">
                         <th>Options</th>
                         <th>Conflicts</th>
                         <th>Dependency</th>
                         <th>Togetherness</th>
                      </tr>
                   </thead>
                   <tbody>
                      @php $i=0; @endphp
                      @forelse($acl_settings as $acl)
                        @php $i++; @endphp
                        <tr class="tr_clone" id="tr_{{$i}}">
                          <td class="w-25">
                            {{Form::select('feature_id['.$i.']',$features,null,['class'=>'form-control main_option','id'=>'main_option'.$i])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('conflict['.$i.'][]',$features,null,['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict'.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('dependency['.$i.'][]',$features,null,['class'=>'form-control  dependency js-example-basic-single','id'=>'togetherness'.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('togetherness['.$i.'][]',$features,null,['class'=>'form-control  togetherness js-example-basic-single','id'=>'dependency'.$i, "multiple"=>"multiple"])}}
                          </td>
                        </tr>
                      @empty
                        <tr class="tr_clone" id="tr_1">
                          <td class="w-25">
                            {{Form::select('feature_id[1]',$features,null,['class'=>'form-control main_option','id'=>'main_option1'])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('conflict[1][]',$features,null,['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict1', "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('dependency[1][]',$features,null,['class'=>'form-control  dependency js-example-basic-single','id'=>'togetherness1', "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('togetherness[1][]',$features,null,['class'=>'form-control  togetherness js-example-basic-single','id'=>'dependency1', "multiple"=>"multiple"])}}
                          </td>
                        </tr>
                      @endforelse
                   </tbody>
                </table>
                <div class="col-md-3 float-left">
                  <button type="button" data-floor-id="{{$floor->id}}" class="btn btn-primary float-left clonetrBtn"><span class="fa fa-plus pr-2"></span>Add Row</button>
                </div>
                <div class="col-md-3 float-right">    
                  <button type="submit" class="btn btn-primary float-right "><span class="fa fa-save pr-2"></span>Save</button>
                </div>
                {{Form::close()}}
             </div>
          </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
