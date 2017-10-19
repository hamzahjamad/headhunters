@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Users</div>

                <div class="panel-body table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Access</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($users as $user)
                          <tr>
                              <td>#{{$user->id}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->have_access ? 'Yes' : 'No'}}</td>
                              <td>{{$user->created_at}}</td>
                              <td>{{$user->updated_at}}</td>
                              <td>
                                  {!! Form::open(['url' => "/users/{$user->id}/update-access"]) !!}
                                      <button type="submit" class="btn btn-default">
                                        <span class="glyphicon {{ $user->have_access  ? 'glyphicon-remove' : 'glyphicon-ok'}}" aria-hidden="true"></span>
                                      </button>

                                  {!! Form::close() !!}
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $users->links() }}
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
