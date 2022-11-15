<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{
    function show($username, $param)
    {

        if (in_array($param, ['saved', 'profile'])) {
            if ($param == 'profile') {
                $posts = User::with('posts')->where('username', $username)->first();
            }else {
                $posts = User::with('saves')->where('id', 1)->get();
                // dd($posts->toArray());
            }
            return view('users.index', [
                'user' => $posts,
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

        auth()->user()->update($validator->validated());

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
        if (Hash::check($request->OldPassword, $user->password)) {
            $hashedPass =  bcrypt($request->password);
            $user->password = $hashedPass;
            $user->update();
            return redirect('/');
        }

        return redirect('/settings?section=password')->withInput()->withErrors(['OldPassword' => 'The old password is incorrect!']);
    }

    function updateImage(Request $request)
    {

        $path = 'storage/users_profile/';
        $file = $request->file('imageInput');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);

        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }

        if (File::exists(public_path($path.auth()->user()->image))) {
            File::delete(public_path($path.auth()->user()->image));
        }

        $userImage = auth()->user()->image;


        auth()->user()->image = $new_image_name;
        auth()->user()->update();

        return response()->json(['status' => 1, 'msg' => 'Image has been changed successfully.', 'name' => $new_image_name]);
    }

    function deleteImage()
    {
        $path = 'storage/users_profile/';
        if (File::exists(public_path($path.auth()->user()->image))) {
            File::delete(public_path($path.auth()->user()->image));
        }

        auth()->user()->image = '';
        auth()->user()->update();
        return redirect('/settings?section=profile')->withInput()->withErrors(['image' => 'Profile image deleted!']);
    }
}
