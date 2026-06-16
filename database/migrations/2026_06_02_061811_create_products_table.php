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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productname', 150);
            $table->string('slug', 200)->unique();
            
            // Giá - giá bán
            $table->decimal('price', 12, 2)->default(0);
            
            // Giá - giá sau khi được giảm
            $table->decimal('pricediscount', 12, 2)->default(0);
            
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            
            // =======
            // khóa ngoại với bảng brands
            // brands.brandid đang là INT UNSIGNED (increments) nên dùng unsignedInteger cho khớp kiểu
            $table->unsignedInteger('brandid')->nullable();
            $table->foreign('brandid')
                ->references('brandid')
                ->on('brands')
                ->nullOnDelete();
                
            // khóa ngoại với bảng categories
            $table->unsignedInteger('cateid');
            $table->foreign('cateid')
                ->references('cateid')
                ->on('categories')
                ->restrictOnDelete();
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