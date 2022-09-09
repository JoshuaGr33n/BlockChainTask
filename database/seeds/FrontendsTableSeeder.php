<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frontends')->insert([
            [
                'key' => 'seo',
                'value' => json_encode([
                    'keywords' => [],
                    'description' => '',
                    'social_title' => '',
                    'social_description' => '',
                    'image' => '',
                ]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'key' => 'gauth',
                'value' => json_encode([
                    'id' => 'DEMO',
                    'secret' => 'DEMO',
                ]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'key' => 'fauth',
                'value' => json_encode([
                    'id' => 'DEMO',
                    'secret' => 'DEMO',
                ]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
