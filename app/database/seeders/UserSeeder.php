<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'       => 'Admin',
            'email'      => 'admin@admin.com',
            'password'   => Hash::make('admin'),
            'role'       => User::ROLE_SUPER_ADMIN,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
