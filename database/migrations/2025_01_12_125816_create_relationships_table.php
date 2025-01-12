<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();  // Auto-incrémenté par défaut
            $table->unsignedBigInteger('created_by');  // L'utilisateur-créateur
            $table->unsignedBigInteger('parent_id');  // L'identifiant du parent
            $table->unsignedBigInteger('child_id');  // L'identifiant de l'enfant
            $table->timestamps();  // Created at, Updated at

            // Clés étrangères
            $table->foreign('parent_id')->references('id')->on('people')->onDelete('cascade');  // Parent
            $table->foreign('child_id')->references('id')->on('people')->onDelete('cascade');  // Enfant
            $table->index('created_by');  // Index pour created_by
            $table->index('parent_id');   // Index pour parent_id
            $table->index('child_id');    // Index pour child_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
