<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Supper Admin',
            'email' => 'admin@site.com',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);
    }
}
