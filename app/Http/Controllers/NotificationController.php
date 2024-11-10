<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index() {
        $usersNotification = User::all();
        // $adminNot = User::where('role', 'admin');
        return view('dashboard.notificatoins', compact('usersNotification'));
    }

    public function sendNotification(Request $request) {
        
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $orderId = $request->order_id;
        $message = 'A request has been sent to cancel the order ID : ';
        $user->notify(new OrderNotification($message, $orderId));

        // $admins = User::where('role', 'admin')->get();
        // $adminMessage ='This Order Cancel Message Requested';
        // if ($admins) {
        //     foreach ($admins as $admin) {
        //         $admins->notify(new OrderNotification($adminMessage));
        //     }
        // }
        return response()->json(['message' => 'A request to cancel the order has been sen']);

    }

    public function readmessage(Request $request) {
        
        $order = Order::find($request->orderId);
        $user = $order->user;
        $not = $user->notifications->where('id', $request->notId);
        // return $not;
        if ($not) {
            $not->markAsRead();
        }
        // $order->user->unreadNotifications->where('id', $request->notID)->markAsRead()]
        // $order->delete();
        return response()->json(['message' => ' you Id']);
    }
}
