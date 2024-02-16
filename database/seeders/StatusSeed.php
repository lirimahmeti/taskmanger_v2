<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $status = ['new', 'në proces', 'gati', 'përfunduar', 'nuk rregullohet'];

        foreach($status as $st){
            Status::create(['name' => $st, ['active' => 0]]);
        }
    }
}
