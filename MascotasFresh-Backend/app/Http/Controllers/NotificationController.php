<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Notification;


class NotificationController extends Controller
{
    //
    public function index() {
        $allNotificactions = Notification::all();
        return ['notifications'=> $allNotificactions];
    }
}
