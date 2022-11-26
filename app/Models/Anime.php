<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['name'] ?? false) {
            // dd('ee');
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
    }

    static function dataFilter($demo, $row)
    {
        $fil = [];
        foreach ($demo as $key => $d) {
            foreach (explode(',', $d->$row) as $key => $value) {
                if ($value && !in_array($value, $fil) && $value != 'Unknown') {  
                    array_push($fil,$value);
                }
            }
        }
        return $fil;
    }
}
