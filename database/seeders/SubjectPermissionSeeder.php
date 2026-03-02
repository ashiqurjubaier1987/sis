<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubjectPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define subject permissions
        $permissions = [
            'subject.view',
            'subject.create',
            'subject.edit',
            'subject.delete',
            'subject.toggle',
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }

        // Assign permissions per role
        // Super Admin — full access
        $superAdmin = Role::where('name', 'Super Admin')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($permissions);
        }

        // Admin — full access
        $admin = Role::where('name', 'Admin')->first();
        if ($admin) {
            $admin->givePermissionTo($permissions);
        }

        // Teacher — view only
        $teacher = Role::where('name', 'teacher')->first();
        if ($teacher) {
            $teacher->givePermissionTo(['subject.view']);
        }

        // Teacher Assistant — view only
        $ta = Role::where('name', 'teacher_assistant')->first();
        if ($ta) {
            $ta->givePermissionTo(['subject.view']);
        }

        // Teacher Accountant — view only
        $ta2 = Role::where('name', 'teacher_accountant')->first();
        if ($ta2) {
            $ta2->givePermissionTo(['subject.view']);
        }

        $this->command->info('Subject permissions seeded and assigned to roles successfully.');
    }
}
