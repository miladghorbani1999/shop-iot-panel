<?php

use App\Models\Brand;
use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dk_id');
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Brand::class);
            $table->string('title_fa')->nullable();
            $table->string('title_en')->nullable();
            $table->json('url');
            $table->json('expert_reviews')->nullable();
            $table->json('review')->nullable();
            $table->json('meta')->nullable();
            $table->json('seo')->nullable();
            $table->string('status');
            $table->string('product_type');
            $table->decimal('price',20,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
