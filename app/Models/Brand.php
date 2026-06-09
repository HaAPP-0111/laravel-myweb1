<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
    protected $table = 'brands';
    protected $primaryKey = 'brandid'; // Kiểm tra lại database xem khóa chính của bạn tên gì (ví dụ: id hoặc brandid)
    protected $fillable = ['brandname', 'slug', 'image', 'status']; // Thêm các cột tương ứng trong DB của bạn
}