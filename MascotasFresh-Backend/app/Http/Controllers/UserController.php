<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
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

    public function update(UserUpdateRequest $request) {
        try {
            $usuario = User::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
           return response()->json([
                'message' => 'User not found.',
                $e
            ], 403);
        }
        $usuario->update($request->all());

        return response()->json(['message'=>'¡Usuario Actualizado!']);
        
    }

    public function delete(Request $request) {
        try {
            $usuario = User::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.',
                $e
            ], 403);
        }
        $usuario->delete();
    
        return response()->json(['message'=>'Usuario Eliminado.']);

    }
}
