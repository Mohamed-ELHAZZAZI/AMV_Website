<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}
