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
                    <h6 class="m-0 font-weight-bold text-primary">Manage User <span class="text-success">Roles</span></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="custom_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th>Name</th>
                                    <th style="width:15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $record)
                                    <tr>
                                        <td>{{ $key+1 }}.</td>
                                        <td>{{ $record->role }}</td>
                                        <td>
                                            @if($record->id <= 2)
                                                All Permissions Granted
                                            @else
                                                <a href="{{url('admin/users/edit-permissions/'.Crypt::encrypt($record->id))}}" class="font-weight-normal">
                                                    <i class="fas fa-edit"></i> Edit Permissions
                                                </a>
                                            @endif
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
@endsection

     