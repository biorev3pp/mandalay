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
               <a href="{{url('admin/features/list/'.Crypt::encrypt($floor->id))}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50 pr-2"></i>Back</a>
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
                         <th class="delete_acl_row"></th>
                      </tr>
                   </thead>
                   <tbody>
                      @php $i=0; @endphp
                      @forelse($acl_settings as $acl)
                        @php $i++; @endphp
                        <tr class="tr_clone" id="tr_{{$i}}">
                          <td class="w-20">
                            {{Form::hidden('feature_id[]',$acl['feature_id'],['class'=>'form-control main_option','id'=>'main_option1'])}}
                            <select class="form-control main_option" id="main_option{{$i}}" name="main_option[{{$i}}]">
                              <option value="0">Choose Option</option>
                              <?php foreach ($features as $ky => $opt): ?>
                                <option <?php if (in_array($ky, $acl_settings) && $ky != $acl['feature_id']) {?> disabled <?php }?> <?php if ($ky == $acl['feature_id']) {?> selected <?php }?> value="{{$ky}}">{{$opt}}</option>
                              <?php endforeach;?>
                            </select>
                          </td>
                          <td class="w-20">
                             {{Form::select('conflict['.$i.'][]',$features,json_decode($acl['conflicts']),['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict'.$idstr.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-20">
                             {{Form::select('dependency['.$i.'][]',$features,json_decode($acl['dependency']),['class'=>'form-control  dependency js-example-basic-single','id'=>'togetherness'.$idstr.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-20">
                             {{Form::select('togetherness['.$i.'][]',$features,json_decode($acl['togetherness']),['class'=>'form-control  togetherness js-example-basic-single','id'=>'dependency'.$idstr.$i, "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-20 delete_acl_row">
                           <a href="#" id="{{$acl['id']}}" class="delete_record_btn" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i> Delete</a>
                          </td>
                        </tr>
                      @empty
                        <!-- <tr><td colspan="5">No data available yet</td></tr> -->
                      @endforelse
                   </tbody>
                </table>
                <div class="col-md-3 float-left">
                  <button type="button" data-floor-id="{{$floor->id}}" class="btn btn-primary float-left clonetrBtn"><span class="fa fa-plus pr-2"></span>Add Row</button>
                </div>
                <div class="col-md-3 float-right saveACLBtn">
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
<!-- Delete Model -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Are you sure, you want to delete this record ?</div>
      <div class="modal-footer ">
          {{Form::open(array('id'=>'delete_form','url'=>url('admin/features/delete-acl')))}}
          {{Form::hidden('delete_id',null,['id'=>'delete_id'])}}
          <button type="submit" class="btn btn-secondary">Yes</button>
          {{Form::close()}}
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>
@endsection
