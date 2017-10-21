<?php

use Illuminate\Database\Seeder;

class TestBatchOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Batch::class, 5)->create()->each(function ($b) {

        	foreach ($this->getAvailableTypes() as $shirtName) {
        		$type = new \App\AvailableBatchType;
        		$type->batch_id = $b->id;
        		$type->name = $shirtName;
        		$type->save();
        	}


        	factory(App\Recipient::class, 2)->create()->each(function ($r) use ($b) {

        		factory(App\ShipmentAddress::class)->create(['recipient_id'=>$r->id])->each(function ($s) use ($b, $r) {

        			foreach ($this->prepOrder() as $type) {
        					$order = new \App\Order;
        					$order->batch_id = $b->id;
        					$order->sleeve_type_id = $type['sleeve_id'];
        					$order->color_id = $type['color_id'];
        					$order->shipment_address_id = $s->id;
        					$order->recipient_id = $r->id;
        					$order->xs = 5;
        					$order->s = 5;
        					$order->m = 5;
        					$order->l = 5;
        					$order->xl = 5;
        					$order->xxl = 5;
        					$order->xxxl = 5;
        					$order->price_per_item = 20.00;
        					$order->save();
        			}
        		});

        	});
    	});
    }


    private function getAvailableTypes()
    {
    	return [
    		'Black Long Sleeve',
    		'Black Short Sleeve',
    		'White Long Sleeve',
    		'White Short Sleeve',
    	];
    }


    private function prepOrder()
    {
    	$orders = [];
		foreach ($this->getColorId() as $color_id) {
			foreach ($this->getSleeveTypeId() as $sleeve_id) {
				$orders[] = ['color_id'=>$color_id, 'sleeve_id'=>$sleeve_id];
			}
		}

        return $orders;			
    }


    private function getColorId()
    {
    	return \App\Color::all()->pluck('id')->toArray();
    }


    private function getSleeveTypeId()
    {
    	return \App\SleeveType::all()->pluck('id')->toArray();
    }
}
