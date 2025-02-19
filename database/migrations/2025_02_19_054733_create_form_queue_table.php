<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('form_queue', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->json('purpose'); // Store multiple selected purposes
            $table->enum('status', ['waiting', 'e-registration', 'oec', 'information_sheet', 'welfare_registration_and_division', 'direct_hire', 'SENA', 'done'])
                ->default('waiting'); // Default status is "waiting"
            $table->boolean('completed')->default(false); // True/False if done
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_queue');
    }
};
