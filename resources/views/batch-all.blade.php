@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Batches</div>

                <div class="panel-body table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($batches->count() == 0)
                      <div class="alert alert-info" role="alert">No batches yet..</div>
                    @else

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Design</th>
                          <th>Batch Name</th>
                          <th>Batch Details</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($batches as $batch)
                          <tr>
                              <td>#{{$batch->id}}</td>
                              <td>
                                <img style="max-width: 140px;" src="{{$batch->design ? asset($batch->design) : 'http://via.placeholder.com/140x140' }}" class="img-responsive" alt="Responsive image">
                              </td>
                              <td>{{$batch->name}}</td>
                              <td>
                                Created At<br>
                                {{$batch->created_at}}<br>
                                <br>
                                Updated At<br>
                                {{$batch->updated_at}}<br>
                              </td>
                              <td>
                                <a class="btn btn-default" href="/batches/{{$batch->id}}" role="button">
                                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a>

                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-title-type="Batch" data-recipient-name="{{$batch->name}}" data-recipient-id="{{$batch->id}}">
                                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $batches->links() }}

                    @endif
                    <hr>

                      <a class="btn btn-default" href="/batches/create" role="button">Create New Batch</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Delete Order</h4>
      </div>
      <div class="modal-body">
      {!! Form::open(['url' => "/batches", 'method'=>'delete', 'id'=>'delete-order']) !!}
          <p>Are you sure want to delete this batch?</p>
      {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="document.getElementById('delete-order').submit();" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>


@endsection
