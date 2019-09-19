<?php

use DockQuiz\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    public function run()
    {

        Role::updateOrCreate([
            [
                'id'    => 1,
                'title' => 'Administrator (can create other users)',
            ],
            [
                'id'    => 2,
                'title' => 'Simple user',
            ],
        ]);
    }
}
