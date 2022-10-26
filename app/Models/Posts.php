<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    public function scopeFilter($query, $filters)
    {
        if ($filters ?? false) {
            $query->where('tags' , 'like' , '%'. $filters . '%');
        }
    }

    public function scopeSearch($query, $search)
    {
        if ($search ?? false) {
            $query->where('description' , 'like' , '%'. $search . '%');
        }
    }
}
