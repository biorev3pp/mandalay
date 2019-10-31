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
          <h6 class="m-0 font-weight-bold text-primary">Manage Your <span class="text-success">Homes</span>
            Easily</h6>
            <a href="{{url('admin/homes/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
              <i class="fas fa-plus fa-sm pr-2"></i>Add A New Home</a>
        </div>
        <!-- Card Body -->
        <div class="card-body" id="custom_table">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=0; @endphp
                @forelse($data as $record)
                @php $i++; @endphp
                <tr>
                <td>{{$i}}.</td>
                  <td>{{$record->title}}</td>
                  <td>{{$statusArray[$record->status]}}</td>
                  <td>
                    <a href="{{url('admin/floors/list/'.Crypt::encrypt($record->id))}}"><i class="fas fa-map"></i> Floors</a>
                    <a href="{{url('admin/homes/edit/'.Crypt::encrypt($record->id))}}"><i class="fas fa-edit"></i> Edit</a>
                    <a href="#" class="delete_record_btn" id="{{Crypt::encrypt($record->id)}}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i> Delete</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4">No Record Found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Logout Modal-->
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
          {{Form::open(array('id'=>'delete_form','url'=>url('admin/homes/delete')))}}
          {{Form::hidden('delete_id',null,['id'=>'delete_id'])}}
          <button type="submit" class="btn btn-secondary">Yes</button>
          {{Form::close()}}
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>
<!-- End of Main Content -->
@endsection

     