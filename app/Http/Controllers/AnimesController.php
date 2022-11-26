<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AnimesController extends Controller
{

    protected function f($arr)
    {
        $data = collect($arr)->flatten();


        $dataFl = [];
        foreach ($data as $item) {

            $p = explode(',', (string) $item);
            foreach ($p as $i) {
                if ($i && !in_array($i, $dataFl)) {
                    $dataFl[] = $i;
                }
            }
        }
        return Arr::sort($dataFl);
    }


    function index(Request $request)
    {
        

        $geners = $this->f(collect(DB::select('select distinct `geners` from `animes`'))->pluck('geners'));
        $demographics = $this->f(collect(DB::select('select distinct `demographics` from `animes`'))->pluck('demographics'));
        $types = $this->f(collect(DB::select('select distinct `type` from `animes`'))->pluck('types'));

        return view('animes.index', [
            'animes' => Anime::filter($request)->simplePaginate(20)->withQueryString(),
            'types' => $types,
            'demog' => $demographics,
            'geners' => $geners,
        ]);
    }
}
