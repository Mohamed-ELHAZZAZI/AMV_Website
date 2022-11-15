<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function scopeFilter($query, $filters)
    {
        if ($filters ?? false) {
            $query->where('tags', 'like', '%' . $filters . '%');
        }
    }

    public function scopeSearch($query, $search)
    {
        if ($search ?? false) {
            $query->where('title', 'like', '%' . $search . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'post_id', 'id');
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }
}
