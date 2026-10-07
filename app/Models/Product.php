<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',       // texto de respaldo
        'category_id',    // 🔴 FK
        'price',
        'stock',
    ];

    // 🔗 Un producto pertenece a una categoría
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
