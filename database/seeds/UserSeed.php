<?php

use DockQuiz\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        DB::table((new User)->getTable())->truncate();

        User::insert([
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin'),
                'role_id'        => 1,
                'remember_token' => '',
            ],
        ]);
    }
}
