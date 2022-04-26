<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login.page');
        }

        return 'SUCCESS';
    }
    public function login(Request $request)
    {
        $data = $request->validate(
            [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ]);
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials))
        {

            return redirect()->route('home');
        }

    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:auth_users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);


         User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

         session()->flash('success' , 'Account Created');
         return redirect()->route('login.page');
    }
}
