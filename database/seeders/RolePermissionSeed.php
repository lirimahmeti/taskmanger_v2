<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role_permissions = [
            'admin' =>
            ['create client','read client','update client','delete client','create job','read job','update job','delete job','create message','read message','update message','delete message','generate report'],
            'staff' => ['create client','read client','update client','create job','read job','update job','create message','read message','update message']
        ];

        foreach($role_permissions as $role => $permissions){
            foreach($permissions as $permission){
                Role::where('name', $role)->first()->givePermissionTo(Permission::where('name',$permission)->first());
            }
        }
    }
}
