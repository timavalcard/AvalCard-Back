<?php
namespace CMS\User\Database\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use CMS\RolePermissions\Models\Role;
use CMS\User\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();


        User::create([
            "name"=>"admin",
            "email"=>"admin@admin.com",
            "password"=>Hash::make("admin")
        ])->assignRole(Role::ROLE_SUPER_ADMIN)->markEmailAsVerified();
    }
}
