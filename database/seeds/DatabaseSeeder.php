<?php

use App\Frontend;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            FrontendsTableSeeder::class,
            GeneralSettingsTableSeeder::class,
            EmailSmsTemplatesTableSeeder::class,
            PluginsTableSeeder::class,
        ]);
    }
}
