@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Batch #{{$batch->id}}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

             
                    <h4>Batch Information</h4>
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-4">
                          <img style="max-width: 140px;" src="{{$batch->design ? asset($batch->design) : 'http://via.placeholder.com/140x140' }}" class="img-responsive" alt="Responsive image">
                        </div>
                        <div class="col-md-8">
                            <h5>Batch Name</h5>
                            {{$batch->name}}
                        </div>
                      </div>
                    </div>

                    <hr>
                    <h4>Order Information</h4>

                    @if($orders->count() == 0)
                      <div class="alert alert-info" role="alert">No orders yet..</div>
                    @else
                    {{ app('request')->input('send') }}
                    <div class="table-responsive">
                      <div class="btn-group pull-right" role="group">
                        <button type="button" class="btn btn-default" onclick="window.location.href='/batches/{{$batch->id}}'" {{app('request')->input('send') ? '' : 'disabled'}}>All</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href='/batches/{{$batch->id}}?send=true'" {{app('request')->input('send') == 'true' ? 'disabled' : ''}}>Send</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href='/batches/{{$batch->id}}?send=false'" {{app('request')->input('send') == 'false' ? 'disabled' : ''}}>Not Send</button>
                      </div>  
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Owner Name</th>
                          <th>Phone Number</th>
                          <th>Address</th>
                          <th>Order Detail</th>
                          <th>Tracking Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($orders->groupBy('recipient_id') as $order)
                          <tr>
                              <td>{{$order->first()->recipient->name}}</td>
                              <td>{{$order->first()->recipient->phone_number}}</td>
                              <td style="max-width: 40px;">
                                {{$order->first()->shipmentAddress()->first()->address}}
                              </td>
                              <td>
                                @foreach($order as $o)
                                  @if( $o->total_price > 0)
                                  {{$o->name}}<br>

                                  @foreach($sizes as $size)
                                    @if($o->{$size})
                                    {{ strtoupper($size). ' : ' . $o->{$size} }}<br>
                                    @endif
                                  @endforeach
                                  <br>

                                  Price : RM{{$o->price_per_item ? $o->price_per_item : '0.00'}}  / item<br>
                                  Total : RM{{$o->total_price}}
                                  <br>
                                  <br>
                                  <hr>
                                  @endif
                                @endforeach
                              </td>
                              <td>
                                {{ $order->first()->shipmentAddress()->first()->tracking_number }}
                                @if(!$order->first()->shipmentAddress()->first()->tracking_number)
                                  <span class="label label-default">not send yet</span>
                                @endif
                              </td>
                              <td>
                                <a class="btn btn-default" href="/batches/{{$batch->id}}/recipients/{{$order->first()->recipient->id}}/edit" role="button">
                                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-title-type="Order" data-recipient-name="{{$order->first()->recipient->name}}" data-recipient-id="{{$order->first()->recipient->id}}">
                                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>

                    @if(app('request')->input('send'))
                      {{ $orders->appends(['send' => app('request')->input('send')])->links() }}
                    @else
                      {{$orders->links()}}
                    @endif
                  </div>
                    @endif

                    <hr>

                      <a class="btn btn-default" href="/batches/{{$batch->id}}/recipients/create" role="button">Create New Order</a>
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
      {!! Form::open(['url' => "/batches/$batch->id/recipients", 'method'=>'delete', 'id'=>'delete-order']) !!}
          <p>Are you sure want to delete this order?</p>
      {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="document.getElementById('delete-order').submit();" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection
