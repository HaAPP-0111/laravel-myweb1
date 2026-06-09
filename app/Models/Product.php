<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Chỉ định chính xác tên bảng trong database
    protected $table = 'products';

    // Đổi sang 'id' để đồng bộ khớp hoàn toàn với câu lệnh SQL ở Controller và Database của bạn
    protected $primaryKey = 'id';

    // Các cột cho phép thêm/sửa dữ liệu (Bổ sung thêm trường pricediscount)
    protected $fillable = [
        'productname',
        'slug',
        'cateid',
        'brandid',
        'image',
        'price',
        'pricediscount', // Bổ sung trường giảm giá này vào đây
        'detail',
        'status'
    ];
}