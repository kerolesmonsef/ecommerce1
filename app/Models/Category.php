<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|Category[] $childrens
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


}
