<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;

    // chỉ định tên bảng trong database
    // (có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc số nhiều)
    protected $table = 'categories';

    // chỉ định khóa chính
    // (có thể bỏ qua khai báo $primaryKey nếu primary key là id)
    protected $primaryKey = 'cateid';

    // các cột cho phép thêm/sửa dữ liệu hàng loạt
=======
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
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    protected $fillable = [
        'catename',
        'slug',
        'description',
        'image',
<<<<<<< HEAD
        'status'
    ];
=======
        'status',
        'sort_order',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cateid', 'cateid');
    }
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
}