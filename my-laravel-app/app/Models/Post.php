<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';
    protected $dates = ['deleted_at'];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeLaravel($query)
    {
        return $query->where('title', 'like', '%Laravel%');
    }
}
