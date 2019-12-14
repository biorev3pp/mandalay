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
                    <h6 class="m-0 font-weight-bold text-primary">Manage Your <span class="text-success">Users</span></h6>
                    <a href="{{url('admin/users/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-plus fa-sm pr-2"></i>Add New User
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="custom_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th style="width:22%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $record)
                                    <tr>
                                        <td>{{ $key+1 }}.</td>
                                        <td>{{ $record->name }}</td>
                                        <td>
                                            {{ $record->roles->role }}
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $record->email }}">{{ $record->email }}</a>
                                        </td>
                                        <td>
                                            <a class="mr-2 font-weight-normal" href="{{url('admin/users/communities/'.Crypt::encrypt($record->id))}}">
                                                <i class="fas fa-edit"></i>Communities
                                            </a>
                                            <a class="mr-2 font-weight-normal" href="{{url('admin/users/edit/'.Crypt::encrypt($record->id))}}">
                                                <i class="fas fa-edit"></i>Edit
                                            </a>
                                            <a class="mr-2 font-weight-normal" href="#" class="delete_record_btn" id="{{Crypt::encrypt($record->id)}}" data-toggle="modal" data-target="#modal-delete">
                                                <i class="fas fa-trash-alt"></i>Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Delete Modal-->
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
                {{Form::open(array('id'=>'delete_form','url'=>url('admin/communities/delete')))}} {{Form::hidden('delete_id',null,['id'=>'delete_id'])}}
                <button type="submit" class="btn btn-secondary">Yes</button>
                {{Form::close()}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
@endsection

     