<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_kategori_lowongans',
            'add_kategori_lowongans',
            'edit_kategori_lowongans',
            'delete_kategori_lowongans',

            'view_lowongans',
            'add_lowongans',
            'edit_lowongans',
            'delete_lowongans',

            'view_lamarans',
            'add_lamarans',
            'edit_lamarans',
            'delete_lamarans',

            'view_kategori_elearning',
            'add_kategori_elearning',
            'edit_kategori_elearning',
            'delete_kategori_elearning',

            'view_elearning',
            'add_elearning',
            'edit_elearning',
            'delete_elearning',

            'view_companies',
            'add_companies',
            'edit_companies',
            'delete_companies',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roles = [
            'Super Admin' => $permissions,
            'Karyawan Internal' => ['view_lowongans'],
            'Pelamar' => ['view_lowongans'],
        ];

        foreach ($roles as $role => $permissions) {
            $role = Role::create(['name' => $role]);
            $role->givePermissionTo($permissions);
        }
    }
}