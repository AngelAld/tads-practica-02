<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    public function family()
    {
        return $this->belongsTo(Families::class);
    }
    protected $fillable = ['name', 'description', 'family_id'];
}
