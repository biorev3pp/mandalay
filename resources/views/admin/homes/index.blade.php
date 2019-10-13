@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$page_title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Homes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">  
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 pb-3">
                  <a href="{{url('admin/homes/create')}}" class="col-md-2 float-right d-inline btn btn-block btn-primary text-white">Add New</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th style="width: 200px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=0; @endphp
                      @forelse($data as $record)
                      @php $i++; @endphp
                      <tr>
                      <td>{{$i}}.</td>
                        <td>{{$record->title}}</td>
                        <td>
                          <a href="{{url('admin/homes/edit/'.Crypt::encrypt($record->id))}}"><i class="fas fa-edit"></i> Edit</a>
                          <a href="#" class="delete_record_btn" id="{{Crypt::encrypt($record->id)}}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="3">No Record Found</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>  
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Delete Modal -->
  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Action</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure, you want to delete this record ?</p>
        </div>
        <div class="modal-footer ">
          {{Form::open(array('id'=>'delete_form','url'=>url('admin/homes/delete')))}}
          {{Form::hidden('delete_id',null,['id'=>'delete_id'])}}
          <button type="submit" class="btn btn-danger">Yes</button>
          {{Form::close()}}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection