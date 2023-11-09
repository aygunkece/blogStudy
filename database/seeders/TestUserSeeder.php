<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mobillium.com',
            'password' => bcrypt('mobillium'),

        ]);
        $admin->assignRole('admin');

        $writer = User::create([
            'name' => 'writer1',
            'email' => 'writer1@mobillium.com',
            'password' => bcrypt('mobillium'),

        ]);
        $writer->assignRole('writer');

        $moderator = User::create([
            'name' => 'moderator1',
            'email' => 'moderator1@mobillium.com',
            'password' => bcrypt('mobillium'),

        ]);
        $moderator->assignRole('moderator');
    }
}
