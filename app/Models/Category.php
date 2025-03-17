<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'keywords';

    protected $fillable = [
        'name',
        'status'
    ];

    public function lostItems()
    {
        return $this->hasMany(LostItem::class, 'keyword_id');
    }

    public function foundItems()
    {
        return $this->hasMany(FoundItem::class, 'keyword_id');
    }
}
