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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained()->onDelete('cascade'); // Врска со Organizer
            $table->string('name'); // Име на настанот
            $table->text('description'); // Краток опис
            $table->string('type'); // Тип на настанот (семинар, работилница, ...)
            $table->dateTime('date_time'); // Датум и време на настанот
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
