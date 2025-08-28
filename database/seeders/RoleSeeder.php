<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: This seeder is prepared for when spatie/laravel-permission is installed
        
        // Uncomment below when spatie/laravel-permission is installed and configured
        
        /*
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kepala_lab']);
        Role::create(['name' => 'laboran']);
        Role::create(['name' => 'dosen']);
        Role::create(['name' => 'mahasiswa']);
        
        // Create permissions
        $permissions = [
            'manage_users',
            'manage_equipment',
            'manage_loans',
            'manage_labs',
            'view_reports',
            'manage_tickets',
        ];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        
        // Assign permissions to roles
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo($permissions);
        
        $kepalaLabRole = Role::findByName('kepala_lab');
        $kepalaLabRole->givePermissionTo(['manage_equipment', 'manage_loans', 'view_reports']);
        
        $laboranRole = Role::findByName('laboran');
        $laboranRole->givePermissionTo(['manage_equipment', 'manage_loans']);
        
        $dosenRole = Role::findByName('dosen');
        $dosenRole->givePermissionTo(['view_reports']);
        
        // Mahasiswa role gets basic permissions by default
        */
    }
}