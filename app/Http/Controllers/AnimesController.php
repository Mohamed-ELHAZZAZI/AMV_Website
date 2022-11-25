<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimesController extends Controller
{
    function index() {

        return view('animes.index', [
            'animes' => DB::table('animes')->orderBy('score', 'desc')->simplePaginate(50)->fragment('animes')
        ]);
    }
}
