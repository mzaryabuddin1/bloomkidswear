<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'category_id', 'name', 'slug', 'image', 'hover_image', 'sku', 'short_description', 'description', 'link_url',
        'price', 'sale_price', 'stock', 'badge', 'rating_count', 'rating_avg', 'is_featured', 'is_recommended',
        'is_active', 'sort_order', 'age_group', 'colors', 'sizes', 'material', 'sold_count',
    ];
    protected $useTimestamps = true;
}
