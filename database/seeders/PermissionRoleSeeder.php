<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin_permissions =  [1,2,3,5,8];
        $organizer_permissions =  [1,4,7];
        $user_permissions =  [8];

        Role::where('name','admin')->firstOrFail()->permissions()->sync($admin_permissions);
        Role::where('name','organizer')->firstOrFail()->permissions()->sync($organizer_permissions);
        Role::where('name','spectator')->firstOrFail()->permissions()->sync($user_permissions);
    }
}
