<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabelPrintSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LabelSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        LabelPrintSettings::create([
            'name' => 'Letra vogel',
            'paper_height' => 25,
            'paper_width' => 40,
            'header_text_size' => 8,
            'body_text_size' => 8,
            'body_text_area_width' => 20,
            'body_text_area_height' => 0,
            'body_text_margin' => 10,
            'content_margin' => 2,
            'qrcode_size' => 2.4,
            'header_height' => 5,
        ]);
    }
}
