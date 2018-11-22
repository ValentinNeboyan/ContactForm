<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MailController;

class OrderController extends Controller
{

    public function create()
    {
        return view('user.create');
    }

    public  function store(Request $request)
    {

        $order = Order::create(request()->all());

        if ($request->hasFile('file')) {

            $path = $request->file('file')->store('public/files');
            $order->file_path=$path;
            $order->save();
        }

        $order_id=$order->id;
        $name=Auth::user()->name;
        Message::create([
            'body'=>$name.': '.$order->body,
            'order_id'=>$order_id,
        ]);

        MailController::send();

        return redirect()->route('orders.show',  $order);
    }


    public function show(Order $order)
    {
        $order_id=$order->id;
        $messages=DB::table('messages')->where('order_id', $order_id)->orderBy('id','desc')->pluck('body');
        return view('user.show')->with(compact('messages', $messages))->with('order', $order);
    }

    public function message(Request $request, Order $order )
    {
        $order_id=request()->order->id;
        $name=Auth::user()->name;
        Message::create([
            'body'=>$name.': '.$request->message,
            'order_id'=>$order_id,
        ]);
        $messages=DB::table('messages')->where('order_id', $order_id)->orderBy('id','desc')->pluck('body');
        return view('user.show')->with(compact('messages', $messages))->with('order', $order);
    }
}
