<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();  // Auto-incrémenté par défaut
            $table->unsignedBigInteger('created_by');  // L'utilisateur-créateur
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birth_name')->nullable();  // Nom de naissance, optionnel
            $table->string('middle_names')->nullable();  // Prénoms intermédiaires, optionnel
            $table->date('date_of_birth')->nullable();  // Date de naissance, optionnelle
            $table->timestamps();  // Created at, Updated at

            // Index
            $table->index('created_by');  // Index pour created_by
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
