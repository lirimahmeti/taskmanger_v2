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
        Schema::table('label_print_settings', function (Blueprint $table) {
            //
            $table->decimal('header_height', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
