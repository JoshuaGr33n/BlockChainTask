<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Demo',
            'lastname' => 'User',
            'username' => 'username',
            'email' => 'user@site.com',
            'mobile' => '28375',
            'password' => bcrypt('username'),
            'address' => json_encode([
                'address' => '',
                'city' => '',
                'state' => '',
                'zip' => '',
                'country' => '',
            ]),

        ]);
        factory(App\User::class, 3)->create();
    }
}
