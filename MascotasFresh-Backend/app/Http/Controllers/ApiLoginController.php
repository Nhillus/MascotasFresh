<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class ApiLoginController extends Controller
{

    public function login(Request $request) {
        
    
        if( Auth::attempt(['email'=>$request->username, 'password'=>$request->password]) ) {
    
            $user = Auth::user();
            $userModel = User::findOrFail($user->id); 
            $userRol = $userModel->rol()->first();
            
            $request->request->add([
                'scope'=>$userRol->nombre_rol
            ]);
            // forward the request to the oauth token request endpoint
            $tokenRequest = Request::create(
            '/oauth/token',
            'post'
            );
            return Route::dispatch($tokenRequest);
            
        }
    }
}
