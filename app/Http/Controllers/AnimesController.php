<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimesController extends Controller
{
    function index() {

        return view('animes.index', [
            'animes' => Anime::all()->slice(0, 20)
        ]);
    }
}
