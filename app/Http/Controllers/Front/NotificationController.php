<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function get(Request $request){
        $notification = $request->user()->unreadNotifications;
        return $notification;
    }

    public function read(Request $request){
        $request->user()->unreadNotifications()->find($request->id)
            ->markAsRead();
        return 'success';
    }
}
