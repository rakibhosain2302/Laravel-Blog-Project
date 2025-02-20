<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles টেবিলে ডাটা ইনসার্ট করা হচ্ছে
        Role::insert([
            [
                'name' => 'Guest',
                'description' => 'Default role for new users',
            ],
            [
                'name' => 'Admin',
                'description' => 'Full access',
            ],
            [
                'name' => 'Editor',
                'description' => 'Can edit content',
            ],
            [
                'name' => 'User',
                'description' => 'Regular user with limited access',
            ],
        ]);
    }
}
