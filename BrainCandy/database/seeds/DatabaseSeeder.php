<?php

use Illuminate\Database\Seeder;
use App\User;

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
        $user = User::create([
            'email' => 'rossjbartlett@gmail.com',
            'name' => 'Ross Bartlett',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'email' => 'timeparadox98@gmail.com',
            'name' => 'Dylan Gordon',
            'password' => Hash::make('password')
        ]);
    }
}
