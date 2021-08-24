<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeeder extends Seeder
{
    public function run()
    {

     DB::table('settings')->insert([
    'site_name' => 'laravels Blog',
    'contact_email' => 'akanmayowa@yahoo.com',
    'contact_number' =>  '07064973701',
    'address' => '8b harvey close, Yaba, Lagos'
    ]);


    }
}
