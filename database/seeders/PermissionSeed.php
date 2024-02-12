<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = ['create client','read client','update client','delete client','create job','read job','update job','delete job','create message','read message','update message','delete message','generate report'];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
