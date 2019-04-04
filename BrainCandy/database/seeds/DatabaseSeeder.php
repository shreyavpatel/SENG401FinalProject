<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Interest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $ross = User::create([
            'email' => 'rossjbartlett@gmail.com',
            'name' => 'Ross Bartlett',
            'password' => Hash::make('password')
        ]);

        $dyl = User::create([
            'email' => 'timeparadox98@gmail.com',
            'name' => 'Dylan Gordon',
            'password' => Hash::make('password')
        ]);

        Interest::create([
            'user_id'=>$ross->id,
            'interest'=>'Calgary Flames'
        ]);
        Interest::create([
            'user_id'=>$ross->id,
            'interest'=>'Rugby'
        ]);


    }
}
