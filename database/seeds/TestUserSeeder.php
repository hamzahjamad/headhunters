<?php

use Illuminate\Database\Seeder;
use App\User;
class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	foreach ($this->adminList() as $email) {
    		$this->makeAdmin($email);
    	}

        factory(App\User::class, 10)->create([ 'have_access' => true ]);
        factory(App\User::class, 10)->create([ 'have_access' => false ]);
    }


    private function makeAdmin($email) 
    {
    	$user = User::where('email', $email)->first();
    	if (!$user) {
    		factory(App\User::class)->create([
				'email' => $email,
				'have_access' => true
			]);
    	}
    }


    private function adminList()
    {
    	return [
			'johnwick@mailinator.com',
			'hangtuah@mailinator.com',
			'annabelle@mailinator.com',
			'grimreaper@mailinator.com',
			'goblin@mailinator.com',
			'narutouzumaki@mailinator.com',
			'asadi@mailinator.com',
			'sasuke@mailinator.com',
			'shufflin@mailinator.com',
			'killbill@mailinator.com',
    	];
    } 
}
