
<?php

use Illuminate\Database\Seeder;
use App\Models\quotes_status_master;

class QuotesStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['quotesstatus' => "Draft", 'status' => 1],
            ['quotesstatus' => "Sent", 'status' => 1],
            ['quotesstatus' => "Approved", 'status' => 1],
            ['quotesstatus' => "Rejected", 'status' => 1],
            ['quotesstatus' => "Cancelled", 'status' => 1],
        ];
        // $quotes_status_master = quotes_status_master::create($data);

        foreach ($data as $instence) {
            $object = new quotes_status_master;
            $object->quotesstatus = $instence['quotesstatus'];
            $object->status = $instence['status'];
            $object->save();  
        }
    }
}
