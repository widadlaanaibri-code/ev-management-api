<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_users',//organizer & admin
            'banned_users',//admin
            'refuse_events',//admin
            'manage_events',//organizer
            'manage_categories',//admin
            'make_reservations',//spectators
            'organizer_statistics',//organizer
            'admin_statistics',//admin

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
