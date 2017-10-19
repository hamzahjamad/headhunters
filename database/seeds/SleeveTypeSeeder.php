<?php

use Illuminate\Database\Seeder;
use App\SleeveType;

class SleeveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {
        foreach($this->sleeves() as $sleeve) {
        	$sleeveData = SleeveType::where('name', $sleeve)->first();
        	if (!$sleeveData) {
        		$this->createSleeveType($sleeve);
        	}
        }
    }

    private function createSleeveType($sleeve)
    {
    	SleeveType::create(['name'=>$sleeve]);
    }

    private function sleeves()
    {
    	return [
    		'long sleeve',
    		'short sleeve'
    	];
    }
}
