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
                            {{Form::hidden('feature_id[]',$acl['feature_id'],['class'=>'form-control main_option','id'=>'main_option1'])}}
                            <select class="form-control main_option" name="main_option[{{$i}}]">
                            <?php foreach ($features as $ky => $opt): ?>
                              <option <?php if(in_array($ky,$acl_settings) && $ky != $acl['feature_id']) {?> disabled <?php } ?> <?php if($ky == $acl['feature_id'] ){ ?> selected <?php } ?> value="{{$ky}}">{{$opt}}</option>
                            <?php endforeach; ?>
                          </select>

                          </td>
                          <td class="w-25">
                             {{Form::select('conflict['.$i.'][]',$features,json_decode($acl['conflicts']),['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict'.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('dependency['.$i.'][]',$features,json_decode($acl['dependency']),['class'=>'form-control  dependency js-example-basic-single','id'=>'togetherness'.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('togetherness['.$i.'][]',$features,json_decode($acl['togetherness']),['class'=>'form-control  togetherness js-example-basic-single','id'=>'dependency'.$i, "multiple"=>"multiple"])}}
                          </td>
                        </tr>
                      @empty
                        <tr class="tr_clone" id="tr_1">
                          <td class="w-25">
                            <select class="form-control main_option" name="feature_id[1]" id="main_option1">
                               <option>Choose Option</option>
                               @forelse($features as $key => $value)
                                  <option value="{{$key}}">{{$value}}</option>
                               @empty
                               @endforelse
                            </select>
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
