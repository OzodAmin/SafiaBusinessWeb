<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permission = [
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'List All Roles'
            ],
            [
                'name' => 'role-update',
                'display_name' => 'Update Role',
                'description' => 'Update Role Information'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'user-create',
                'display_name' => 'Create User',
                'description' => 'Create New User'
            ],
            [
                'name' => 'user-list',
                'display_name' => 'Display User Listing',
                'description' => 'List All Users'
            ],
            [
                'name' => 'user-update',
                'display_name' => 'Update User',
                'description' => 'Update User Information'
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Delete User',
                'description' => 'Delete User'
            ],
            [
                'name' => 'category-create',
                'display_name' => 'Create Client',
                'description' => 'Create New Client'
            ],
            [
                'name' => 'category-list',
                'display_name' => 'Display Client Listing',
                'description' => 'List All Clients'
            ],
            [
                'name' => 'category-update',
                'display_name' => 'Update Client',
                'description' => 'Update Client Information'
            ],
            [
                'name' => 'category-delete',
                'display_name' => 'Delete Client',
                'description' => 'Delete Client Information'
            ],
            [
                'name' => 'product-create',
                'display_name' => 'Create Job',
                'description' => 'Create New Job'
            ],
            [
                'name' => 'product-list',
                'display_name' => 'Display Job Listing',
                'description' => 'List All Job'
            ],
            [
                'name' => 'product-update',
                'display_name' => 'Update Job',
                'description' => 'Update Job Information'
            ],
            [
                'name' => 'product-delete',
                'display_name' => 'Delete Job',
                'description' => 'Delete Job Information'
            ],
            [
                'name' => 'cart-create',
                'display_name' => 'Create Candidate',
                'description' => 'Create New Candidate'
            ],
            [
                'name' => 'cart-list',
                'display_name' => 'Display Candidate Listing',
                'description' => 'List All Candidate'
            ],
            [
                'name' => 'cart-update',
                'display_name' => 'Update Candidate',
                'description' => 'Update Candidate Information'
            ],
            [
                'name' => 'cart-delete',
                'display_name' => 'Delete Candidate',
                'description' => 'Delete Candidate Information'
            ]
        ];
        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
