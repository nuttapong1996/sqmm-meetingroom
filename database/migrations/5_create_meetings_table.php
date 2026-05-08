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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title' , 255);
            $table->foreignId('room_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('emp_code' , 20);
            $table->string('dept',30);
            $table->foreignId('room_status_id')->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('zoom_use');
            $table->string('link_zoom' , 255);
            $table->boolean('audio_system');
            $table->string('other_equipment' , 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
