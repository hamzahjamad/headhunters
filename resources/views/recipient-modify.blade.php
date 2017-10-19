@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Order Information</div>

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

                    @if(isset($orders))
                      @php
                        $recipient_id = $orders->first()->recipient_id;
                      @endphp
                    {!! Form::open(['url' => "/batches/$bid/recipients/$recipient_id", 'method'=>'put']) !!}
                        <input type="hidden" name="shipment_address_id" value="{{$orders->first()->shipment_address_id}}">
                    @else
                    {!! Form::open(['url' => "/batches/$bid/recipients"]) !!}
                    @endif

                      <input type="hidden" name="batch_id" value="{{$bid}}">

                      <hr>
                      <h4>Buyer Information</h4>
                      <div class="form-group">
                        <label>Name*</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{isset($orders)? $orders->first()->recipient->name : ''}}">
                      </div>
                      <div class="form-group">
                        <label>Phone Number*</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" value="{{isset($orders)? $orders->first()->recipient->phone_number : ''}}">
                      </div>
                      <div class="form-group">
                        <label>Address*</label>
                        <textarea class="form-control" rows="3" name="address" placeholder="Address">{{isset($orders)? $orders->first()->shipmentAddress->address : ''}}</textarea>
                      </div>


                      <hr>
                      <h4>Order Information</h4>
                      <div class="container-fluid">
                        <div class="row">
                          @php
                            $i = 0;
                          @endphp

                          @foreach($shirts as $shirt)

                             @if(isset($orders))
                                <input type="hidden" name="shirts{{'['.$shirt->color.']['.$shirt->sleeve.'][id]'}}" value="{{ $orders->get($i)->id }}">
                             @endif

                          <div class="col-md-6">
                              <h5>{{$shirt->name}}</h5>

                               @foreach($sizes as $size) 
                               <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">{{strtoupper($size)}}</div>
                                  <input type="number" name="shirts{{'['.$shirt->color.']['.$shirt->sleeve.']['.$size.']'}}" class="form-control" id="exampleInputAmount" placeholder="Amount" value="{{isset($orders) && $orders->get($i)->{$size} ? $orders->get($i)->{$size}  : ''}}">
                                </div>
                              </div>
                              @endforeach
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">Price Per Item</div>
                                  <input type="number" name="price_per_item{{'['.$shirt->color.']['.$shirt->sleeve.']'}}" class="form-control" id="exampleInputAmount" placeholder="Amount" value="{{isset($orders) && $orders->get($i)->price_per_item > 0 ? $orders->get($i)->price_per_item : ''}}">
                                </div>
                              </div>   
                          </div>

                          @php
                            ++$i;
                          @endphp

                          @endforeach

                        </div>

                      </div>


                      <hr>
                      <h4>Tracker Information [ For Admin To Fill ]</h4>
                      <div class="form-group">
                        <label>Track Number</label>
                        <input type="text" class="form-control" name="tracking_number" placeholder="Track Number" value="{{isset($orders)? $orders->first()->shipmentAddress->tracking_number : ''}}">
                      </div>
                      <hr>

                      <button type="submit" class="btn btn-default">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
