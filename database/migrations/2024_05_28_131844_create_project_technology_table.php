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
        Schema::create('project_technology', function (Blueprint $table) {

            // colonna di relazione con projects
            $table->unsignedBigInteger('project_id');

            // FK su questa colonna
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete();

            // se viene eliminato un post o un tag viene cancellato il record della relazione
            //colonna di relazione con technologies
            $table->unsignedBigInteger('technology_id');

            // FK su questa colonna
            $table->foreign('technology_id')
                ->references('id')
                ->on('technologies')
                ->cascadeOnDelete();
            // se viene eliminato un post o una categoria viene cancellato il record della relazione

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
