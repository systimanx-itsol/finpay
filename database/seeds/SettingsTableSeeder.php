<?php

use Illuminate\Database\Seeder;
use App\Models\System;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['key' => "language", 'value' => "English"],
            ['key' => "timezone", 'value' => "America/Indiana/Indianapolis"],
            ['key' => "tax_rounding", 'value' => "2"],
            ['key' => "date", 'value' => "ca-ES"],
            ['key' => "base_currency", 'value' => ""],
            ['key' => "timeformat", 'value' => "0"],
            ['key' => "quantities", 'value' => "2"],
            ['key' => "financial_date", 'value' => "2019-01-01"],
        ];
        foreach ($data as $instence) {
            $object = new System;
            $object->key = $instence['key'];
            $object->value = $instence['value'];
            $object->save();
        }
    }
}
