<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin=Role::create(['name'=>'admin']);
        $roleUser=Role::create(['name'=>'user']);

        $admin = User::create([
            'name'=>'john doe',
            'email'=>'doe@gmail.com',
            'password'=> Hash::make('12345678'),

        ]);

        $user = User::create([
            'name'=>'david mold',
            'email'=>'david@gmail.com',
            'password'=> Hash::make('12345678'),
        ]);


        $admin->assignRole($roleAdmin);
        $user->assignRole($roleUser);
    }
}