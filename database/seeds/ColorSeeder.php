<?php

use Illuminate\Database\Seeder;
use App\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         foreach($this->colors() as $color) {
        	$colorData = Color::where('name', $color)->first();
        	if (!$colorData) {
        		$this->createColor($color);
        	}
         }
    }

    private function createColor($color)
    {
    	Color::create(['name'=>$color]);
    }

    private function colors()
    {
    	return [
    		'black',
    		'white'
    	];
    }
}
