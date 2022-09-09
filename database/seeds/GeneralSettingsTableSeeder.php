<?php

use Illuminate\Database\Seeder;

class GeneralSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'sitename'        => 'INK',
            'cur_text'        => 'USD',
            'cur_sym'         => '$',
            'mail_config'     => '{"name":"php"}',
            'active_template' => 'basic',
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
    }
}
