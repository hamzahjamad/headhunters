<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Order;
use App\AvailableBatchType;

class BatchController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'auth.admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::orderBy('id', 'DESC')->paginate(5);
        return view('batch-all', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('batch-modify');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);

        $batch = new Batch;
        $batch->name = $request->name;


        if($request->file('design')){
            $imageName = str_random(10).date('Y-m-d'). '.' .$request->file('design')->getClientOriginalExtension();
            $path = 'storage/designs/';
            $full_path = $path.$imageName;
            $request->file('design')->move(base_path() . '/public/'.$path, $imageName);

            $batch->design = $full_path;
        }

        $batch->save();



        if ($request->type) {
            foreach ($request->type as $color => $sleeve) {
                foreach ($sleeve as $k => $v) {
                    $available_type = new AvailableBatchType;
                    $available_type->batch_id = $batch->id;
                    $available_type->name = ucwords($color .' '.str_replace("_"," ",$k));
                    $available_type->save();
                }
            }
        }


        return redirect('batches');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $batch = Batch::find($id);

        $orders = $batch->orders()->with(['recipient','shipmentAddress']);

        if ($request->send === 'true') {
            $orders = $orders->whereHas('shipmentAddress', function($query){
                            $query->whereNotNull('shipment_addresses.tracking_number');
                        });
        }

        if ($request->send === 'false') {
            $orders = $orders->whereHas('shipmentAddress', function($query){
                            $query->whereNull('shipment_addresses.tracking_number');
                        });
        }

        $orders = $orders->orderBy('id','DESC')->paginate(20);
        $sizes = $this->getSizes();

        $is_send = $request->send === 'true';

        return view('batch-view', compact('batch', 'orders', 'sizes', 'is_send'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);
        $order_ids = Order::where('batch_id', $id)->pluck('id')->toArray();
        if ($batch) {
            $batch->delete();
            if ($order_ids) {
                Order::destroy($order_ids);
            }
        }
        return back();
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
