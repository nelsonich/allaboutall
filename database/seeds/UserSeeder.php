<?php

use App\Models\RBAC\Role;
use App\User;
use Illuminate\Database\Seeder;
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
        $superAdmin = Role::where('name', Role::SUPER_ADMIN)->first();
        $admin = Role::where('name', Role::ADMIN)->first();
        $moderator = Role::where('name', Role::MODERATOR)->first();
        $writer = Role::where('name', Role::WRITER)->first();

        User::create([
            'name' => 'Nelson',
            'email' => 'xachatryan.nelsonich@gmail.com',
            'password' => Hash::make('00000000'),
            'role_id' => $superAdmin->id,
        ]);

        User::create([
            'name' => 'Klavdia',
            'email' => 'klavdia.xachatryan@mail.ru',
            'password' => Hash::make('00000000'),
            'role_id' => $admin->id,
        ]);

        User::create([
            'name' => 'Moderator',
            'email' => 'moderator@allaboutall.com',
            'password' => Hash::make('00000000'),
            'role_id' => $moderator->id,
        ]);

        User::create([
            'name' => 'Writer',
            'email' => 'writer@allaboutall.com',
            'password' => Hash::make('00000000'),
            'role_id' => $writer->id,
        ]);
    }
}
