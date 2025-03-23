<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LostItem extends Model
{
    /** @use HasFactory<\Database\Factories\LostItemFactory> */
    use HasFactory;

    protected $table = 'lost_items';

    protected $fillable = [
        'title',
        'slug',
        'username',
        'userphone',
        'class_id',
        'last_location',
        'description',
        'photo',
        'lost_date',
        'status',
        'category_id',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function keyword()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
