<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name'=>'Admin',
                'email'=>'admin@admin.com',
                'alamat'=>'null',
                'no_telepon'=>'083806682587',
                'password'=> Hash::make('12345678'),
                'is_admin' => true
                ]
        ]);

        DB::table('orders')->insert([
            [
                'id' => 123,
                'user_id' => 1,
                'name' => 'User',
                'alamat' => 'Null',
                'no_telepon' => '404',
                'catatan' => 'Null',
                'total_harga' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
