<?php

namespace App\Models;

use App\Models\LostItem;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'status',
    ];

    public function lostItems()
    {
        return $this->hasMany(LostItem::class, 'class_id');
    }

    public function getTotalReportsAttribute()
    {
        return $this->lostItems()->count();
    }
}
