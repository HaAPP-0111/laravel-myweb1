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
            // Đặt tên khóa chính là brandid theo thiết kế Lab 06 của bạn
            $table->id('brandid'); 
            $table->string('brandname', 150); 
            $table->string('slug', 150)->unique();
            $table->string('image', 200)->nullable();
            $table->tinyInteger('status')->default(1); // 1: Hoạt động, 0: Tạm ẩn
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
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