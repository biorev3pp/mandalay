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
                    <h6 class="m-0 font-weight-bold text-primary">Manage Communities For <span class="text-success"> {{ $home->title }}</span></h6>
                    <div class="two_btn_DIV">
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#modal-add">
                            <i class="fas fa-plus fa-sm pr-2"></i>Add New Community
                        </a>
                        <a href="{{url('admin/homes')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-arrow-left fa-sm pr-2"></i>Back
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="custom_table">
                    <div class="table-responsive">
                        <table class="table table-bordered"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th>Communities</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->count())
                                    @foreach($data as $key => $record)
                                        <tr>
                                            <td>{{ $key+1 }}.</td>
                                            <td>{{ $record->community->name }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger font-weight-normal" href="#" class="delete_record_btn" id="{{Crypt::encrypt($record->id)}}" data-toggle="modal" data-target="#modal-delete">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr> <td colspan="3"> No Community added yet</td> </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Add Community Modal-->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @if($communities->count() >= 1)
                    {{Form::open(array('id'=>'portfolio_form','url'=>url('admin/homes/addcommunity')))}} 
                    {{Form::hidden('home_id',$home->id, ['id'=>'home_id'])}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Community</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="community_id">Communities</label>
                                <select name="community_id" id="community_id" class="form-control">
                                    @foreach($communities as $community)
                                        <option value="{{ $community->id }}">{{ $community->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add It</button>
                        </div>
                    {{Form::close()}}
                @else
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Community</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="community_id">No New Community to add</label>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endif
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
                {{Form::open(array('id'=>'delete_form','url'=>url('admin/homes/delete-community')))}} 
                {{Form::hidden('delete_id',null,['id'=>'delete_id'])}}
                {{Form::hidden('home_id',$home->id,['id'=>'home_id'])}}
                <button type="submit" class="btn btn-secondary">Yes</button>
                {{Form::close()}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
@endsection

     