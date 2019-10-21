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
               {{Form::open(['url'=>route('saveAclSettings',request()->route('id')),'method'=>'post','id'=>'save-acl-settings-form'])}}
                <table class="table table-bordered" width="100%" cellspacing="0">
                   <thead>
                      <tr class="bg-dark text-white">
                         <th>Options</th>
                         <th>Conflicts</th>
                         <th>Dependency</th>
                         <th>Togetherness</th>
                      </tr>
                   </thead>
                   <tbody>
                     @php $index = 0; @endphp
                     @forelse($acl_settings as $value)

                     <tr class="tr_clone">

                        <td class="w-25">
                          <select class="form-control main_option" name='main_option['.$index.']'>
                            <?php foreach ($features as $ky => $opt): ?>
                              <option <?php if(in_array($ky,$selected_options) && $ky != $value->option_for) {?> disabled <?php } ?> <?php if($ky == $value->option_for ){ ?> selected <?php } ?> value="{{$ky}}">{{$opt}}</option>
                            <?php endforeach; ?>
                          </select>

                        </td>
                        <td class="w-25">
                           {{Form::select('conflict['.$index.']',$features,json_decode($value->conflicts),['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict'.$index.'', "multiple"=>"multiple"])}}
                        </td>
                        <td class="w-25">
                           {{Form::select('togetherness['.$index.']',$features,json_decode($value->togetherness),['class'=>'form-control  togetherness js-example-basic-single','id'=>'togetherness'.$index.'', "multiple"=>"multiple"])}}
                        </td>
                        <td class="w-25">
                           {{Form::select('dependency['.$index.']',$features,json_decode($value->dependency),['class'=>'form-control  dependency js-example-basic-single','id'=>'dependency'.$index.'', "multiple"=>"multiple"])}}
                        </td>
                     </tr>
                      @php $index++; @endphp
                       @empty
                       <tr class="tr_clone">

                          <td class="w-25">
                             {{Form::select('main_option[]',$features,null,['class'=>'form-control main_option ','id'=>'status',])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('conflict[]',$features,null,['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict', "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('togetherness[]',$features,null,['class'=>'form-control  togetherness js-example-basic-single','id'=>'togetherness', "multiple"=>"multiple"])}}
                          </td>
                          <td class="w-25">
                             {{Form::select('dependency[]',$features,null,['class'=>'form-control  dependency js-example-basic-single','id'=>'dependency', "multiple"=>"multiple"])}}
                          </td>
                       </tr>
                     @endforelse

                      <tr>
                         <td colspan="4"><button type="submit" class="btn btn-primary float-right clonetr"><span class="fa fa-plus pr-2"></span>Add Row</button></td>
                      </tr>
                   </tbody>
                </table>
                {{Form::close()}}
             </div>
          </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
