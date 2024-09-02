<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_admin = User::where('email', "agency@mayagroup.ma")->first();
        if (!$check_admin) {
            $user = new User();
            $user->name = 'Maya Agency';
            $user->email = 'agency@mayagroup.ma';
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
