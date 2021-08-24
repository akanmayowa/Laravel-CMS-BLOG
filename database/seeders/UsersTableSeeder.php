<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $user = User::create([
            'name' => 'mayowa akan',
            'email' => 'mayowaakan@gmail.com',
            'password' => '12345678',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'admin'=> 1
        ]);



        DB::table('profiles')->insert([
            'user_id' => $user->id,
             'avatar' => 'uploads/avatars/1.png',
            'about' => "lorem lorem lorry up ",
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);
    }
}
