@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Permissions For <span class="text-success">{{ $role->role }}</span></h6>
                    <a href="{{url('admin/users/roles')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-arrow-left fa-sm pr-2"></i>Back To List
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="custom_table">
                    <div class="table-responsive">
                        {{Form::open(array('url'=>url('admin/users/save-permissions'), 'id'=>'portfolio_form'))}}

                        {{ Form::hidden('role_id',$role->id )}}
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th>Module</th>
                                    <th>Add</th>
                                    <th>Read</th>
                                    <th>Write</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $key => $module)
                                    @if(isset($data) && (array_key_exists($module->id, $data )))
                                        <tr>
                                            <td style="width:5%"> {{ $key+1 }} 
                                                <input type="hidden" name="permission[{{ $module->id }}][id]" value="{{ $data[$module->id]['id'] }}">
                                            </td>
                                            <td> {{ $module->name }} </td>
                                            <td>
                                                @if($data[$module->id]['plus'] == 1)
                                                    <input class="wh25" type="checkbox" value="1" checked name="permission[{{ $module->id }}][plus]" >
                                                @else
                                                    <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][plus]" >
                                                @endif
                                            </td>
                                            <td>
                                                @if($data[$module->id]['view'] == 1)
                                                    <input class="wh25" type="checkbox" value="1" checked name="permission[{{ $module->id }}][view]" >
                                                @else
                                                    <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][view]" >
                                                @endif
                                            <td>
                                                @if($data[$module->id]['modify'] == 1)
                                                    <input class="wh25" type="checkbox" value="1" checked name="permission[{{ $module->id }}][modify]" >
                                                @else
                                                    <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][modify]" >
                                                @endif
                                            <td>
                                                @if($data[$module->id]['trash'] == 1)
                                                    <input class="wh25" type="checkbox" value="1" checked name="permission[{{ $module->id }}][trash]" >
                                                @else
                                                    <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][trash]" >
                                                @endif
                                        </tr>
                                    @else
                                        <tr>
                                            <td style="width:5%"> {{ $key+1 }} </td>
                                            <td> {{ $module->name }} </td>
                                            <td>
                                                <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][plus]" >
                                            </td>
                                            <td>
                                                <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][view]" >
                                            <td>
                                                <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][modify]" >
                                            <td>
                                                <input class="wh25" type="checkbox" value="1" name="permission[{{ $module->id }}][trash]" >
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-2 float-right">
                            <button type="submit" class="btn btn-primary btn-block float-right"><span class="fa fa-save pr-2"></span>Save</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

     