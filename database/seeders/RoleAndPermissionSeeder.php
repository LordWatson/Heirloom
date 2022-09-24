<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        Permission::create(['name' => 'create item']);
        Permission::create(['name' => 'edit item']);
        Permission::create(['name' => 'delete item']);
        Permission::create(['name' => 'give item']);

        Permission::create(['name' => 'create will']);
        Permission::create(['name' => 'edit will']);
        Permission::create(['name' => 'delete will']);
        Permission::create(['name' => 'publish will']);

        // create roles and assign created permissions
        // this can be done as separate statements
        $role = Role::create(['name' => 'user'])
            ->givePermissionTo([
                'create item',
                'edit item',
                'delete item',
                'give item',
                'create will',
                'edit will',
                'delete will',
                'publish will'
            ]);
    }
}
