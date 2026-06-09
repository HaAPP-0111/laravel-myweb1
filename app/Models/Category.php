<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Chỉ định tên bảng trong database
    // (Có thể bỏ qua nếu tên bảng đặt theo nguyên tắc số nhiều tiếng Anh là 'categories')
    protected $table = 'categories';

    // Chỉ định khóa chính của bảng
    // (Có thể bỏ qua nếu khóa chính trong database đặt tên là 'id')
    protected $primaryKey = 'cateid';

    // Các cột cho phép thêm/sửa dữ liệu hàng loạt (Mass Assignment)
    protected $fillable = [
        'catename',
        'slug',
        'description',
        'image',
        'status',
        'sort_order',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cateid', 'cateid');
    }
}