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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title_fa');
            $table->string('title_en');
            $table->json('url');
            $table->boolean('visibility');
            $table->boolean('is_premium')->nullable();
            $table->boolean('is_miscellaneous')->nullable();
            $table->boolean('is_name_similar')->nullable();
            $table->json('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
