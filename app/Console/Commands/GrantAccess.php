<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class GrantAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:grant-access {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable access for the user by their email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
           $email = $this->argument('email');

           $user = User::where('email', $email)->first();
           if ($user) {
               $user->have_access = $user->have_access ? false : true;
               $user->save();

               $access = $user->have_access ? 'granted' : 'denied';
               $message = 'Access '. $access . ' for user with email : '.$email ;

               if ($user->have_access) {
                $this->info($message);
               }else{
                $this->error($message);
               }

           } else {
              $this->error('User with email ' . $email . ' not found.');
           }


    }
}
