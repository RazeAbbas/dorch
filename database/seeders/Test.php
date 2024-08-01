<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create and save the super admin user
        User::create([
            'email' => 'admin@admin.com',
            'password' => 12345678, // Use bcrypt to hash the password
            'first_name' => 'admin',
            'second_name' => 'dorch',
            'role' => 'super admin',
        ]);
    }
}
