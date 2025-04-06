<?php
namespace CMS\RolePermissions\Database\Seeds;
use Illuminate\Database\Seeder;
use CMS\RolePermissions\Models\Permission;
use CMS\RolePermissions\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::$permissions as $permission){
            Permission::findOrCreate($permission);
        }

        foreach (Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }
    }
}
