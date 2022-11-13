<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = [
            'fullname' => 'Nathaphong Khruates',
            'username' => 'ghost',
            'email' => 'phichitonline@gmail.com',
            'password' => Hash::make('ghUD2gES'),
            'tel' => '0619921666',
            'avatar' => 'https://via.placeholder.com/400x400.png/001234?text=ghost',
            'role' => '1',
            'remember_token' => '1234567890'
        ];

        User::create($data);

        // เรียกตัว User Factory ทำการ ranfdom ข้อมูล Facker
        User::factory(99)->create();
    }
}
