<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('permission:create-permission-routes');

        /*Super Admin Permissions*/
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now()
        ]);

        $permissions = Permission::pluck('id','id')->all();
        $role = Role::create(['name' => 'Super Admin']);
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        /*Student Permissions*/
        $student= User::create([
            'name' => 'Student',
            'email' => 'student@student.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now()
        ]);

        $studetnPermissions=[
            'sanctum.csrf-cookie','login','register','logout','password.request','password.email','password.update','password.reset','password.confirm','verification.notice','verification.verify','verification.resend','home','dashboard','profile','users.update'
        ];

        $studentRole = Role::create(['name' => 'Student']);
        $studentRole->syncPermissions($studetnPermissions);
        $student->assignRole([$studentRole->id]);
    }

}
