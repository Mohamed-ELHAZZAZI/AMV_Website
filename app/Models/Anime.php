<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    public function scopeFilter($query, $request)
    {

        $query
            ->when($request->has('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->has('geners') && $request->geners != "All", function ($q) use ($request) {
                $q->where('geners', 'like', '%' . $request->geners . '%');
            })
            ->when($request->has('demographics') && $request->demographics != "All", function ($q) use ($request) {
                $q->where('demographics', 'like', '%' . $request->demographics . '%');
            })
            ->when($request->has('type') && $request->type != "All", function ($q) use ($request) {
                $q->where('type', 'like', '%' . $request->type . '%');
            });

    }
}
