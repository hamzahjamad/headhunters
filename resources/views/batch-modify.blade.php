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
                      <hr>

                      <h5><b>Type*</b></h5>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="type[black][long_sleeve]" checked> Black Long Sleeve
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="type[black][short_sleeve]" checked> Black Short Sleeve
                        </label>
                      </div>


                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="type[white][long_sleeve]" checked> White Long Sleeve
                        </label>
                      </div>


                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="type[white][short_sleeve]" checked> White Short Sleeve
                        </label>
                      </div>

                      <button type="submit" class="btn btn-default">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
