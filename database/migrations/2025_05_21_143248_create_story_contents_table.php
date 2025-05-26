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
        Schema::create('story_contents', function (Blueprint $table) {
            $table->id();
            $table->char('key')->uniqid();
            $table->char('type');
            $table->text('value')->nullable();
            $table->foreignId('story_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_contents');
    }
};
