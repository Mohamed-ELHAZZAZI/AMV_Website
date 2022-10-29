<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    function show($username, $param)
    {

        if (in_array($param, ['saved', 'profile'])) {
            return view('users.index', [
                'user' => User::with('posts')->where('username', '=', $username)->first(),
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
            'name' => ['required', 'string', 'min:4', 'max:15'],
            'username' => ['required', 'min:4', 'max:10', Rule::unique('users', 'username')],
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

    function updateProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4|max:15',
            'gender' => 'required|string|in:Male,Female',
            'birthday' => 'required|date|after:01/01/1950|before:02/01/2015',
            'about' => 'required|min:19|max:250'
        ]);

        if ($validator->fails()) {
            return redirect('/settings?section=profile')->withInput()->withErrors($validator);
        }

        auth()->user()->update( $validator->validated());

        return redirect('/u/@' . auth()->user()->username . '/profile');
    }

    function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'min:4', 'max:10', 'unique:users,username,' . auth()->user()->id],
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ]);

        if ($validator->fails()) {
            return redirect('/settings?section=account')->withInput()->withErrors($validator);
        }

        $user = auth()->user();
        $user->update($validator->validate());

        return redirect('/u/@' . $user->username . '/profile');
    }

    function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'OldPassword' => 'required',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect('/settings?section=password')->withInput()->withErrors($validator);
        }

        $user = auth()->user();
        if(Hash::check($request->OldPassword, $user->password)){
            $hashedPass =  bcrypt($request->password);
            $user->password = $hashedPass;
            $user->update();
            return redirect('/');
        }

        return redirect('/settings?section=password')->withInput()->withErrors(['OldPassword' => 'The old password is incorrect!']);
        
    }
}
