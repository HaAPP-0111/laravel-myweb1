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

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'productname',
        'slug',
        'cateid',
        'brandid',
        'image',
        'price',
        'pricediscount',
        'description', 
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
