<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // * Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // * Create permissions
        $usersPermissions = [
            'get users',
            'get user',
            'create user',
            'edit user',
            'delete user'
        ];

        $postsPermissions = [
            'get posts',
            'get post',
            'create post',
            'edit post',
            'delete post'
        ];

        $commentsPermissions = [
            'get comments',
            'get comment',
            'create comment',
            'edit comment',
            'delete comment'
        ];

        foreach (array_merge($usersPermissions, $postsPermissions, $commentsPermissions) as $permission) {
            Permission::create(['name' => $permission]);
        }

        // * Assign permissions to roles
        $adminRole->givePermissionTo($usersPermissions, $postsPermissions, $commentsPermissions);

        $userRole->givePermissionTo($postsPermissions, $commentsPermissions);
    }
}
