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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('mechanic_name'); // Име и презиме на механичарот
            $table->string('client_name');   // Име и презиме на клиентот
            $table->string('vehicle_make');  // Марка на возилото
            $table->string('vehicle_model'); // Модел на возилото
            $table->string('license_plate')->unique(); // Регистрациска табличка (уникатна)
            $table->text('description');     // Опис на сервисната интервенција
            $table->decimal('price', 8, 2);  // Цена на интервенцијата (со 2 децимали)
            $table->date('date_received');   // Датум на прием на возилото

            // Опционално поле
            $table->date('date_completed')->nullable(); // Датум на завршување на сервисот (опционално)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
