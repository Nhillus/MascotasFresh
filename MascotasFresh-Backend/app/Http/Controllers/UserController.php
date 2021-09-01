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
        $allUsers = User::all();
        return ['usuarios'=> $allUsers];        
    }
    public function user(Request $request) {
        
        return $request->user();

    }
    public function store(UserRegisterRequest $request) {
        $usuario= User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'rol_id'=> $request->rol_id,
            'password'=> Hash::make($request->password),
        ]);
        return response()->json(["success"=>true, 
                                 "message" =>'usuario creado', 
                                 "usuario" => $usuario],200);
    }
}
