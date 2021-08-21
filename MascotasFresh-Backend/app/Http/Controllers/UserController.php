<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    //
    public function index() {
        return User::all();
    }
    public function user(Request $request) {
        
        return $request->user();

    }
    public function register(UserRegisterRequest $request) {
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
        return 'usuario creado';
    }
}
