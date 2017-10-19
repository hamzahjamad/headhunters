@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->have_access)
                        <a href="/batches">View all batches</a>
                    @else
                        <div class="alert alert-info" role="alert">Your account are still not active, please ask admin to activate your account.</div>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
