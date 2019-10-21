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
               {{Form::open()}} 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr class="bg-dark text-white">
                         <th>Options</th>
                         <th>Conflicts</th>
                         <th>Dependency</th>
                         <th>Togetherness</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td class="w-25">
                            {{Form::select('main_option',$features,null,['class'=>'form-control','id'=>'status'])}}
                         </td>
                         <td class="w-25">
                            {{Form::select('conflict',$features,null,['class'=>'form-control','id'=>'status'])}}
                         </td>
                         <td class="w-25">
                            {{Form::select('togetherness',$features,null,['class'=>'form-control','id'=>'status'])}}
                         </td>
                         <td class="w-25">
                            {{Form::select('dependency',$features,null,['class'=>'form-control','id'=>'status'])}}
                         </td>
                      </tr>
                      <tr>
                         <td colspan="4"><button class="btn btn-primary float-right"><span class="fa fa-plus pr-2"></span>Add Row</button></td>
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