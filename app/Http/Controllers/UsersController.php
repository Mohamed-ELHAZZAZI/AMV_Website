<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    function register()
    {
        return view('users.register');
    }

    function login()
    {
        return view('users.login');
    }

    function store(Request $request)
    {
        $SignUpFields = $request->validate([
            'name' => ['required','string', 'min:4' , 'max:15'],
            'username' => ['required', 'min:4' , 'max:10', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $SignUpFields['password'] = bcrypt($SignUpFields['password']);

        $user = User::create($SignUpFields);

        auth()->login($user);

        return redirect('/');
    }

    function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    function authenticate(Request $request)
    {
        $loginFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($loginFields)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput();
    }
}
