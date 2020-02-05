<?php

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
        $this->call(UserTableSeeder::class);
        $this->call(QuotesStatusMasterSeeder::class);
        $this->call(InvoiceStatusMasterSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
