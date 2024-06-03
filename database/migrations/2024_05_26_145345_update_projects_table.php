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
        Schema::table('projects', function (Blueprint $table) {
            // 1. creare la colonna della FOREIGN KEY

            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // 2. assegnare la FK alla colonna creata
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
            // ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // 1. si elimina la foreign key

            //elimino in base al nome della FK
            // $table->dropForeign('posts_type_id_foreign');

            // elimino in base al nome della colonna
            $table->dropForeign(['type_id']);

            // 2. si elimina la colonna

            $table->dropColumn('type_id');
        });
    }
};
