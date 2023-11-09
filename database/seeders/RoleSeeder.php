<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'moderator',
                'guard_name' => 'web'

            ],
            [
                'name' => 'writer',
                'guard_name' => 'web'

            ],
            [
                'name' => 'reader',
                'guard_name' => 'web'

            ]
        ];

        Role::insert($roles);
    }
}
