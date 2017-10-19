<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use App\SleeveType;
use App\Recipient;
use App\ShipmentAddress;
use App\Order;
use App\Batch;

class RecipientController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'auth.admin']);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bid)
    {
        $shirts = $this->getShirts();
        $sizes = $this->getSizes();
        $batch = Batch::find($bid);
        return view('recipient-modify', compact('shirts', 'sizes', 'bid', 'batch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $bid)
    {
        $this->validate($request, [
            'name'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'batch_id' => 'required',
        ]);

        $recipient = new Recipient;
        $recipient->name = $request->name;
        $recipient->phone_number = $request->phone_number;
        $recipient->save();

        $address = new ShipmentAddress;
        $address->address = $request->address;
        $address->tracking_number = $request->tracking_number;
        $address->recipient_id = $recipient->id;
        $address->save();

        foreach ($request->shirts as $key => $value) {
            $color = Color::where('name', $key)->first();

            foreach ($value as $k => $v) {
                $shirt = SleeveType::where('name', $k)->first();

                if ($color && $shirt) {
                    $order = new Order;
                    $order->color_id = $color->id;
                    $order->batch_id = $request->batch_id;
                    $order->sleeve_type_id = $shirt->id;
                    $order->shipment_address_id = $address->id;
                    $order->recipient_id = $recipient->id;

                    foreach ($v as $size => $amount) {
                              $order->{$size} = $amount;
                    }

                    $order->price_per_item = $request->price_per_item[$key][$k];
                    $order->save();
                }
            }
        }

        return redirect("/batches/$bid");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bid, $id)
    {        
        $shirts = $this->getShirts();
        $sizes = $this->getSizes();
        $batch = Batch::find($bid);
        $orders = Order::where('recipient_id', $id)->get(); 
        return view('recipient-modify', compact('shirts', 'sizes', 'bid', 'batch', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bid, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'batch_id' => 'required',
        ]);

        $recipient = Recipient::find($id);
        $recipient->name = $request->name;
        $recipient->phone_number = $request->phone_number;
        $recipient->save();

        $address = ShipmentAddress::find($request->shipment_address_id);
        $address->address = $request->address;
        $address->tracking_number = $request->tracking_number;
        $address->recipient_id = $recipient->id;
        $address->save();


        foreach ($request->shirts as $key => $value) {
            $color = Color::where('name', $key)->first();

            foreach ($value as $k => $v) {
                $shirt = SleeveType::where('name', $k)->first();

                if ($color && $shirt) {
                    $order = Order::find($v['id']);
                    $order->color_id = $color->id;
                    $order->batch_id = $request->batch_id;
                    $order->sleeve_type_id = $shirt->id;
                    $order->shipment_address_id = $address->id;
                    $order->recipient_id = $recipient->id;

                    unset($v['id']);
                    foreach ($v as $size => $amount) {
                              $order->{$size} = $amount;
                    }

                    $order->price_per_item = $request->price_per_item[$key][$k];
                    $order->save();
                }
            }
        }

        return redirect("/batches/$bid");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bid, $id)
    {
        $recipient = Recipient::find($id);
        $address_ids = ShipmentAddress::where('recipient_id', $id)->pluck('id')->toArray();
        $order_ids = Order::where('recipient_id', $id)->pluck('id')->toArray();
        if ($recipient && $address_ids && $order_ids) {
            $recipient->delete();
            ShipmentAddress::destroy($address_ids);
            Order::destroy($order_ids);
        }
        return back();
    }


    private function getShirts()
    {
        $shirtColors = Color::all();
        $shirtSleeveType = SleeveType::all();

        $shirts = [];
        foreach ($shirtColors as $color) {
            foreach ($shirtSleeveType as $sleeve) {
                $shirts[] = [
                    'name' => ucwords($color->name .' '.$sleeve->name),
                    'color'=> $color->name,
                    'sleeve'=> $sleeve->name,
                    'xs' => null,
                    's' => null,
                    'm' => null,
                    'l' => null,
                    'xl' => null,
                    'xxl' => null,
                    'xxxl' => 5,
                ];
            }
        }

        return json_decode(json_encode($shirts), FALSE);
    }


    private function getSizes()
    {
        return [
            'xs',
            's',
            'm',
            'l',
            'xl',
            'xxl',
            'xxxl',
        ];
    }
}
