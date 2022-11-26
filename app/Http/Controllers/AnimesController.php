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
        

        $geners = $this->f(collect(DB::select('select `geners` from `anime_geners` order by `geners` DESC'))->pluck('geners'));
        $demographics = $this->f(collect(DB::select('select `demographics` from `anime_demographics` order by `demographics` DESC'))->pluck('demographics'));
        $types = $this->f(collect(DB::select('select `types` from `anime_types` order by `types` DESC'))->pluck('types'));
        $ratings = $this->f(collect(DB::select('select `rating` from `anime_rating`'))->pluck('rating'));

        return view('animes.index', [
            'animes' => Anime::filter($request)->simplePaginate(20)->withQueryString(),
            'types' => $types,
            'demographics' => $demographics,
            'geners' => $geners,
            'ratings' => $ratings,
        ]);
    }
}
