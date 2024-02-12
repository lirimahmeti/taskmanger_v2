<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('label_print_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('paper_height', 8, 2);              //mm
            $table->decimal('paper_width', 8, 2);               //mm
            $table->unsignedInteger('header_text_size');        //px
            $table->unsignedInteger('body_text_size');          //px
            $table->decimal('body_text_area_width', 8, 2);      //mm
            $table->decimal('body_text_area_height', 8, 2);     //mm
            $table->unsignedInteger('body_text_margin');        //px
            $table->decimal('content_margin', 8, 2);            //mm
            $table->decimal('qrcode_size', 8, 2);               //number
            $table->boolean('chosen')->default(true);   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
