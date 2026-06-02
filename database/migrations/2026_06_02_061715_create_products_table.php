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
        
        // Hàm này tự động tạo ra 2 cột: created_at và updated_at
        $table->timestamps(); 

        // =======
        // Khóa ngoại với bảng brands
        $table->foreignId('brandid')
              ->nullable()
              ->constrained('brands')
              ->nullOnDelete();

        // Khóa ngoại với bảng categories (Đã được tối ưu ngắn gọn giống bảng brands)
        $table->foreignId('cateid')
              ->constrained('categories', 'cateid') // Chỉ định rõ cột khóa chính ở bảng categories là 'cateid'
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
