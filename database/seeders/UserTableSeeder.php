<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'slug' => 'superadmin',
            'address' => 'tenjolayar',
            'phone' => '6283823386071',
            'username' => 'superadmin',
            'email' => 'admin@larossa.id',
            'email_verified_at' => now(),
            'gender' => 'Laki-laki',
            'password' => bcrypt('admin123'),
            'role' => 0
        ]);
    }
}
