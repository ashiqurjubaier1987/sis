<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ----------------------------------------------------------------
        // 1. PERMISSIONS
        // ----------------------------------------------------------------
        $subjectPermissions = [
            'subject.view',
            'subject.create',
            'subject.edit',
            'subject.delete',
            'subject.toggle',
        ];

        foreach ($subjectPermissions as $perm) {
            Permission::firstOrCreate(
                ['name'       => $perm],
                ['guard_name' => 'web']
            );
        }

        // ----------------------------------------------------------------
        // 2. ROLES
        // ----------------------------------------------------------------
        $roles = [
            'Super Admin',
            'Admin',
            'Teacher',
            'Student',
            'Parent',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name'       => $roleName],
                ['guard_name' => 'web']
            );
        }

        // ----------------------------------------------------------------
        // 3. ASSIGN PERMISSIONS TO ROLES
        // ----------------------------------------------------------------

        // Super Admin — full access to everything
        Role::where('name', 'Super Admin')->first()
            ->syncPermissions($subjectPermissions);

        // Admin — full access to everything
        Role::where('name', 'Admin')->first()
            ->syncPermissions($subjectPermissions);

        // Teacher — full access to subjects
        Role::where('name', 'Teacher')->first()
            ->syncPermissions($subjectPermissions);

        // Student — view only
        Role::where('name', 'Student')->first()
            ->syncPermissions(['subject.view']);

        // Parent — view only
        Role::where('name', 'Parent')->first()
            ->syncPermissions(['subject.view']);

        $this->command->info('✓ Roles created:    ' . implode(', ', $roles));
        $this->command->info('✓ Permissions created: ' . implode(', ', $subjectPermissions));
        $this->command->info('✓ Permissions assigned to all roles successfully.');
    }
}
