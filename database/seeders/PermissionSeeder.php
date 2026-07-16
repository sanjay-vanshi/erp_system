<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // Departments
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',

            // Designations
            'view designations',
            'create designations',
            'edit designations',
            'delete designations',

            // Employees
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',

            // Attendance
            'view attendances',
            'create attendances',
            'edit attendances',
            'delete attendances',

            // Leaves
            'view leaves',
            'create leaves',
            'edit leaves',
            'delete leaves',
            'approve leaves',
            'reject leaves',

            // Payrolls
            'view payrolls',
            'create payrolls',
            'edit payrolls',
            'delete payrolls',

            // Roles
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',

            // Activity Logs
            'view activity logs',

            // Reports
            'view reports',

            // holidays
            'view holidays',
            'create holidays',
            'edit holidays',
            'delete holidays',

            // employee documents
            'view employee documents',
            'create employee documents',
            'edit employee documents',
            'delete employee documents',

            // company settings
            'view company settings',
            'edit company settings',

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate(

                [
                    'name' => $permission,
                ],

                [
                    'guard_name' => 'web',
                ]

            );

        }
    }
}
