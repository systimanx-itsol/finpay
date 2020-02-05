<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        
        $user = User::create([
            'company_id' =>"company",
            'name' => "user",
            'password' => bcrypt("123456"),
            'email' => "admin@finpay.ml",
            'status' => 0
        ]); 
    }
}
