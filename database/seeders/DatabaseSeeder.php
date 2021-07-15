<?php

namespace Database\Seeders;

use App\Models\User;
use Encore\Admin\Models\Administrator;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $super_admin   = Role::create(['name' => 'super-admin']);
        $super_admin->givePermissionTo(Permission::all());

        $user = User::create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminadmin'),
            'name' => 'Super Admin'
        ]);
        $user->assignRole($super_admin);

        Administrator::create([
            'username' => 'admin@admin.com',
            'password' => bcrypt('adminadmin'),
            'name' => 'Admin'
        ]);
    }
}
