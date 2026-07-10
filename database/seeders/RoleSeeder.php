<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [

            [
                'name' => 'Admin',
                'description' => 'Full system access.',
                'status' => 'Active',
            ],

            [
                'name' => 'HR Manager',
                'description' => 'Manage employees, attendance, leaves and payroll.',
                'status' => 'Active',
            ],

            [
                'name' => 'Accountant',
                'description' => 'Manage payroll and financial records.',
                'status' => 'Active',
            ],

            [
                'name' => 'Department Manager',
                'description' => 'Manage department employees and approvals.',
                'status' => 'Active',
            ],

            [
                'name' => 'Employee',
                'description' => 'Employee self-service access.',
                'status' => 'Active',
            ],

        ];

        foreach ($roles as $role) {

            Role::updateOrCreate(
                ['name' => $role['name']],
                [
                    'description' => $role['description'],
                    'status' => $role['status'],
                ]
            );

        }
    }
}
