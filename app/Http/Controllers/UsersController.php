<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function show($id, $param)
    {
        if (in_array($param, ['saved', 'posts'])) {
            return view('users.index', [
                'posts' => Posts::all(),
                'param' => $param,
            ]);
        }

        return abort('404');
    }
}
