<?php

use App\Models\Genre;
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
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('synopsis');
            $table->string('developer');
            $table->string('publisher');
            $table->integer('release_year');
            $table->foreignIdFor(Genre::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('cover')
                ->nullable();
            $table->string('description')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
