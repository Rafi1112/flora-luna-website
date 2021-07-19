<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect([
            'create post', 'list gems order', 'list item order',
            'edit gems price', 'create product', 'create item', 'assign permission'
        ]);

        $permissions->each(function ($permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        });

        $role = Role::findById(2);
        $role->syncPermissions([1,2,3]);
    }
}
