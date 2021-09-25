<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Notification;
use App\Producto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotificationController extends Controller
{
    //
    public function index() {
        $allNotifications = Notification::all();
        if($allNotifications)
        {
            foreach($allNotifications as $Notification)
            {
                try {
                    $ProductoNombre = Producto::where('id',$Notification->product_id)->pluck('nombre');
                    $ProductoCantidad = Producto::where('id',$Notification->product_id)->pluck('cantidad');
                    $Notification['ProductoNombre'] = $ProductoNombre;
                    $Notification['ProductoCantidad'] = $ProductoCantidad;
                } catch (ModelNotFoundException $e) {
                    //throw $th;
                    return response()->json([
                        'message' => 'Product not found.',
                        $e
                    ], 404);
                }
            }
        }
        return ['notifications'=> $allNotifications];
    }
}
