@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Batch Information</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => "/batches", 'files' => true]) !!}
                      <div class="form-group">
                        <label>Name*</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                      </div>
                     <div class="form-group">
                        <label>Design</label>
                        <input type="file" name="design">
                        <p class="help-block">Put design over here</p>
                      </div>

                      <button type="submit" class="btn btn-default">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
