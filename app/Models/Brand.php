<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model {
    use SoftDeletes;
    protected $table = 'brands';
    protected $primaryKey = 'brandid'; // Kiểm tra lại database xem khóa chính của bạn tên gì (ví dụ: id hoặc brandid)
    protected $fillable = ['brandname', 'slug', 'image', 'status']; // Thêm các cột tương ứng trong DB của bạn
}