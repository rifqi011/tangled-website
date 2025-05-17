<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoundItem extends Model
{
    /** @use HasFactory<\Database\Factories\FoundItemFactory> */
    use HasFactory;

    protected $table = 'found_items';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'photo',
        'found_date',
        'found_location',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function retrieval()
    {
        return $this->hasOne(Retrieval::class, 'found_item_id');
    }

    public function retrievals()
    {
        return $this->hasMany(Retrieval::class);
    }
}
