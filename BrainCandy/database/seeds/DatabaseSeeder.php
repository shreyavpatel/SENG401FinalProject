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
    }
}
