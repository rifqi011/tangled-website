<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrieval extends Model
{
    use HasFactory;

    protected $table = 'retrievals';

    protected $fillable = [
        'found_item_id',
        'username',
        'userphone',
        'class_id',
        'retrieval_date',
        'notes'
    ];

    public function foundItem()
    {
        return $this->belongsTo(FoundItem::class, 'found_item_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
