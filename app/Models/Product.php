<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
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
=======
    protected $table = 'products';

    protected $fillable = [
        'productname',
        'slug',
        'price',
        'pricediscount',
        'image',
        'description',
        'status',
        'brandid',
        'cateid',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }
}
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
