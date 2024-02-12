<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusColorSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //['new', 'në proces', 'gati', 'përfunduar', 'nuk rregullohet'];
        $statuses = Status::all();
        $statusColor = ['danger', 'warning', 'primary', 'success', 'secondary'];

        foreach ($statuses as $index => $status) {
            // Update each status with its corresponding color
            Status::where('id', $status->id)->update(['color' => $statusColors[$index]]);
        }
    }
}
