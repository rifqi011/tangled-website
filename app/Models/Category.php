<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'status'
    ];

    public function lostItems()
    {
        return $this->hasMany(LostItem::class, 'category_id');
    }

    public function foundItems()
    {
        return $this->hasMany(FoundItem::class, 'category_id');
    }

    public function getReportCountAttribute()
    {
        return $this->lostItems()->count() + $this->foundItems()->count();
    }
}
