<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'family_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function family()
    {
        return $this->belongsTo(Families::class);
    }
}
