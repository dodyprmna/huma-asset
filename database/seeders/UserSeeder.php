<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Dody',
            'nip'   => 'admin',
            'alamat' => 'simokerto',
            'status'    => 1,
            'no_telp'   => '08888',
            'email' => 'dody@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
