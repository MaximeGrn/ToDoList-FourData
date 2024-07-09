<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('todo_lists', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            // ... autres colonnes si besoin
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('todo_lists');
    }
};
