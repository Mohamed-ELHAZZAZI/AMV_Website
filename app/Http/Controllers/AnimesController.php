<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimesController extends Controller
{
    function index()
    {
        $geners = Anime::dataFilter(DB::table('animes')->select(DB::raw('geners'))->groupBy('geners')->get(), 'geners');
        $demog = Anime::dataFilter(DB::table('animes')->select(DB::raw('demographics'))->groupBy('demographics')->get(), 'demographics');
        $types = Anime::dataFilter(DB::table('animes')->select(DB::raw('type'))->groupBy('type')->get(), 'type');
        sort($geners);
        sort($demog);
        sort($types);
        return view('animes.index', [
            'animes' => Anime::orderBy('score', 'DESC')->filter(request(['name']))->simplePaginate(20),
            'types' => $types,
            'demog' => $demog,
            'geners' => $geners,
        ]);
    }
}